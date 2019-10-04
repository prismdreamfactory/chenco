function debounced(delay, fn) {
  let timerId;
  return function(...args) {
    if (timerId) {
      clearTimeout(timerId);
    }
    timerId = setTimeout(() => {
      fn(...args);
      timerId = null;
    }, delay);
  };
}

($ => {
  const $window = $(window);
  const $page = $('#page');

  const openLinksInNewTab = () => {
    $('a')
      .filter('[href^="http"], [href^="//"]')
      .not('[href*="' + window.location.host + '"]')
      .attr('rel', 'noopener noreferrer')
      .attr('target', '_blank');
  };

  const initSlider = () => {
    $('.home-slick').slick({
      dots: true,
      arrows: true
    });
  };

  /*
   *  newMap
   *
   *  This function will render a Google Map onto the selected jQuery element
   *
   *  @type	function
   *  @date	8/11/2013
   *  @since	4.3.0
   *
   *  @return	n/a
   */

  function newMap() {
    const $el = $('#map');
    const $markers = $el.find('.marker');

    const args = {
      zoom: 16,
      center: new google.maps.LatLng(0, 0),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    // create map
    const map = new google.maps.Map($el[0], args);

    // add a markers reference
    map.markers = [];

    // add markers
    $markers.each(function() {
      addMarker($(this), map);
    });

    // center map
    centerMap(map);

    // return
    return map;
  }

  /*
   *  addMarker
   *
   *  This function will add a marker to the selected Google Map
   *
   *  @type	function
   *  @date	8/11/2013
   *  @since	4.3.0
   *
   *  @param	$marker (jQuery element)
   *  @param	map (Google Map object)
   *  @return	n/a
   */

  function addMarker($marker, map) {
    const latlng = new google.maps.LatLng(
      $marker.attr('data-lat'),
      $marker.attr('data-lng')
    );

    const rootUrl = document.location.origin;

    // custom marker icons
    const icons = {
      defaultIcon: {
        url: `${rootUrl}/wp-content/uploads/2019/08/Pin.svg`
      },
      activeIcon: {
        url: `${rootUrl}/wp-content/uploads/2019/08/Pin-active.svg`
      }
    };

    // create marker
    const marker = new google.maps.Marker({
      position: latlng,
      map: map,
      icon: icons.defaultIcon
    });

    // add to array
    map.markers.push(marker);

    // if marker contains HTML, add it to an infoWindow
    if ($marker.html()) {
      // create info window
      const infowindow = new google.maps.InfoWindow({
        content: $marker.html(),
        maxWidth: 400
      });

      let activeMarker;

      // show info window when marker is clicked
      google.maps.event.addListener(marker, 'click', function() {
        this.setIcon(icons.activeIcon);
        infowindow.open(map, marker);
        activeMarker = this;
      });

      google.maps.event.addListener(infowindow, 'closeclick', function() {
        activeMarker.setIcon(icons.defaultIcon);
      });
    }
  }

  /*
   *  centerMap
   *
   *  This function will center the map, showing all markers attached to this map
   *
   *  @type	function
   *  @date	8/11/2013
   *  @since	4.3.0
   *
   *  @param	map (Google Map object)
   *  @return	n/a
   */

  function centerMap(map) {
    const bounds = new google.maps.LatLngBounds();

    // loop through all markers and create bounds
    $.each(map.markers, function(i, marker) {
      const latlng = new google.maps.LatLng(
        marker.position.lat(),
        marker.position.lng()
      );

      bounds.extend(latlng);
    });

    // only 1 marker?
    if (map.markers.length == 1) {
      // set center of map
      map.setCenter(bounds.getCenter());
      map.setZoom(16);
    } else {
      // fit to bounds
      map.fitBounds(bounds);
    }
  }

  // on document ready
  $(() => {
    // initialize functions

    if ($('body').hasClass('home')) {
      initSlider();
      newMap();
    }

    $('body, html').animate({ scrollTop: 0 }, 0);

    if ($('body').hasClass('touch')) {
      //
    } else {
      //
    }
  });
})(jQuery);
