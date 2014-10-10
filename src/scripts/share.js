( function( $, window, document, undefined ) {


  /**
   * Counters manager
   * http://toster.ru/q/18977
   */

  var services = {
    facebook: {
      counterUrl: 'http://graph.facebook.com/fql?q=SELECT+total_count+FROM+link_stat+WHERE+url%3D%22{url}%22&callback=?',
      convertNumber: function(data) {
        return data.data[0].total_count;
      }
    },
    twitter: {
      counterUrl: 'http://urls.api.twitter.com/1/urls/count.json?url={url}&callback=?',
      convertNumber: function(data) {
        return data.count;
      }
    },
    vkontakte: {
      counterUrl: 'http://vkontakte.ru/share.php?act=count&url={url}&index={index}',
      counter: function(jsonUrl, deferred) {
        var options = services.vkontakte;
        if (!options._) {
          options._ = [];
          if (!window.VK) window.VK = {};
          window.VK.Share = {
            count: function(idx, number) {
              options._[idx].resolve(number);
            }
          };
        }

        var index = options._.length;
        options._.push(deferred);
        $.ajax({
          url: makeUrl(jsonUrl, {index: index}),
          dataType: 'jsonp'
        });
      }
    }
  };

  var counters = {
    promises: {},
    fetch: function(service, url) {
      if (!counters.promises[service]) counters.promises[service] = {};
      var servicePromises = counters.promises[service];

      if (servicePromises[url]) {
        return servicePromises[url];
      }
      else {
        var options = services[service],
          deferred = $.Deferred(),
          jsonUrl = options.counterUrl && makeUrl(options.counterUrl, {url: url});

        if ($.isFunction(options.counter)) {
          options.counter(jsonUrl, deferred);
        }
        else if (options.counterUrl) {
          $.getJSON(jsonUrl)
            .done(function(data) {
              try {
                var number = data;
                if ($.isFunction(options.convertNumber)) {
                  number = options.convertNumber(data);
                }
                deferred.resolve(number);
              }
              catch (e) {
                deferred.reject(e);
              }
            });
        }

        servicePromises[url] = deferred.promise();
        return servicePromises[url];
      }
    }
  };

  function makeUrl(url, context) {
    return template(url, context, encodeURIComponent);
  }

  function template(tmpl, context, filter) {
    return tmpl.replace(/\{([^\}]+)\}/g, function(m, key) {
      // If key don't exists in the context we should keep template tag as is
      return key in context ? (filter ? filter(context[key]) : context[key]) : m;
    });
  }

  $( '.share' ).each( function() {

    var $share = $( this ),
      shareUrl = $share.data( 'url' ),
      shareTotal = 0;

    $.each(services, function(service) {

      if ( $share.data( service ) == 'yep' ) {

        counters.fetch( service, shareUrl ).done(function( number ) {
          number = parseInt(number, 10);
          if (!number) number = 0;

          shareTotal += number;
          $share
            .find( '.share__count' )
            .html( shareTotal );
        });
      }

    });



  } );

} )( jQuery, window, document );