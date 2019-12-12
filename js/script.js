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
    if ($('.slick').length) {
      $('.slick').slick({
        dots: true,
        arrows: true,
        infinite: false,
        slidesToShow: 3
      });
    }
  };

  const initTabs = () => {
    if ($('.tabs').length) {
      $('[data-tab]').on('click', function(e) {
        $(this)
          .addClass('active')
          .siblings('[data-tab]')
          .removeClass('active');
        $('.tab-container')
          .find('[data-content=' + $(this).data('tab') + ']')
          .addClass('active')
          .siblings('[data-content]')
          .removeClass('active');

        e.preventDefault();
      });
    }

    // $('[data-tab=4]').trigger('click');
  };

  const loginModal = () => {
    const $link = $('#menu-item-113 a');

    $link.on('click', function(e) {
      e.preventDefault();
      this.blur();

      html.modal();
    });
  };

  /**
   * Google map coordinates
   */
  const center = {
    usa: new google.maps.LatLng(38.901187, -110.914306),
    asia: new google.maps.LatLng(28.441223, -238.391588),
    global: new google.maps.LatLng(40.141496, -168.588005)
  };

  /*
   *  newMap
   *
   *  This function will render a Google Map onto the selected jQuery element
   *
   *  @return	n/a
   */

  function newMap(styles) {
    const $el = $('#map');
    const $markers = $el.find('.marker');

    const args = {
      minZoom: 3,
      maxZoom: 8,
      zoom: 4,
      center: center['usa'],
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: false,
      streetViewControl: false,
      // disableDefaultUI: true,
      styles
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
    // centerMap(map);

    initLocationTabs(map);
    initMapSwitch(map);

    // return
    return map;
  }

  /*
   *  addMarker
   *
   *  This function will add a marker to the selected Google Map
   *
   *  @param	$marker (jQuery element)
   *  @param	map (Google Map object)
   *  @return	n/a
   */

  function addMarker($marker, map) {
    const latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));
    const type = $marker.attr('data-type').toLowerCase();

    // custom marker icon colors for each asset type
    const icons = {
      office: 'rgb(37, 79, 123)',
      multifamily: 'rgb(191, 144, 1)',
      land: 'rgb(87, 135, 171)',
      industrial: 'rgb(121, 175, 153)'
    };

    // marker svg allowing options
    const createMarker = color => {
      const svg = `data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10" fill="${color}"/></svg>`;

      return svg;
    };

    // create marker
    const marker = new google.maps.Marker({
      position: latlng,
      map: map,
      icon: createMarker(icons[type])
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
   *  @param	map (Google Map object)
   *  @return	n/a
   */

  function centerMap(map) {
    const bounds = new google.maps.LatLngBounds();

    // loop through all markers and create bounds
    $.each(map.markers, function(i, marker) {
      const latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());

      bounds.extend(latlng);
    });

    // const markerCluster = new MarkerClusterer(map, map.markers, {
    //   imagePath:
    //     'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
    // });

    // only 1 marker?
    // if (map.markers.length == 1) {
    //   // set center of map
    //   map.setCenter(bounds.getCenter());
    //   map.setZoom(16);
    // } else {
    // fit to bounds
    // map.fitBounds(bounds);
    // }
  }

  function initLocationTabs(map) {
    const $tabs = $('.map__tab');

    $tabs.each(function() {
      $(this).on('click', () => {
        let country = $(this).attr('data-center');

        $tabs.removeClass('mod--active');
        $(this).addClass('mod--active');

        country === 'global' ? map.setZoom(3) : map.setZoom(4);
        map.setCenter(center[country]);
      });
    });
  }

  function initMapSwitch(map) {
    const $options = $('.map__switch-item');

    $options.each(function() {
      $(this).on('click', () => {
        let country = $(this).attr('data-current');

        $options.removeClass('mod--active');
        $(this).addClass('mod--active');
      });
    });
  }

  // on document ready
  $(() => {
    // initialize functions
    loginModal();
    initTabs();
    initSlider();

    // if ($('body').hasClass('home')) {
    // initSlider();
    // }

    if ($('#map').length) {
      $.getJSON('/wp-content/themes/chenco/js/map-styles.json', json => {
        newMap(json);
      });
    }

    $('body, html').animate({ scrollTop: 0 }, 0);

    if ($('body').hasClass('touch')) {
      //
    } else {
      //
    }
  });
})(jQuery);
