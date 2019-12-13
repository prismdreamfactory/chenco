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
   * Google map jQuery selectors and coordinates
   */
  const center = {
    usa: new google.maps.LatLng(38.901187, -110.914306),
    asia: new google.maps.LatLng(28.441223, -238.391588),
    global: new google.maps.LatLng(40.141496, -168.588005)
  };
  const regionCenters = {
    norcal: [39.781569, -122.19576],
    socal: [32.155, -119.033081],
    hawaii: [31.906707, -132.501246],
    south: [30.705239, -98.67815],
    mountain: [39.05847, -105.706326],
    midwest: [41.65778, -90.853814],
    southeast: [31.082342, -82.767718],
    northeast: [38.56669, -76.621757]
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
    const $markers = $('.marker');
    const $currentMarkers = $(`.marker[data-current=1]`);
    const $historicalMarkers = $(`.marker[data-current=0]`);

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

    // Create map
    const map = new google.maps.Map($el[0], args);

    // Add a markers reference
    map.markers = [];

    // Initial marker load
    addMarkers($currentMarkers, map);

    initLocationTabs(map);

    const legendStats = [0, 0, 0, 0];

    // Switch between current/historical
    const $options = $('.map__switch-item');
    $options.each(function() {
      const $this = $(this);
      const showCurrent = $this.data('current');

      $this.on('click', function() {
        $options.removeClass('mod--active');
        $this.addClass('mod--active');

        removeMarkers(map.markers);
        showCurrent ? addMarkers($currentMarkers, map) : addMarkers($historicalMarkers, map);
        calculateLegend(map, legendStats);
      });
    });

    /* zoom event */
    // google.maps.event.addListener(map, 'zoom_changed', function() {
    //   let zoomLevel = map.getZoom();
    //   removeMarkers(map.markers);

    //   if (zoomLevel === 5) {
    //     for (let center in regionCenters) {
    //       const coordinates = regionCenters[center];

    //       const marker = new google.maps.Marker({
    //         position: new google.maps.LatLng(coordinates[0], coordinates[1]),
    //         map: map,
    //         icon: document.location.origin + `/wp-content/themes/chenco/assets/circle.svg`
    //       });

    //       // add to array
    //       map.markers.push(marker);
    //     }
    //   } else {
    //     addMarkers($currentMarkers, map);
    //   }
    // });

    map.addListener(
      'bounds_changed',
      debounced(200, () => calculateLegend(map, legendStats))
    );

    return map;
  }

  /*
   * Grab marker data using title field and calculate legend
   * [office sqft, units, acres, ind sqft]
   */
  function calculateLegend(map, legendStats) {
    legendStats = [0, 0, 0, 0];

    for (let i = 0; i < map.markers.length; i++) {
      if (map.getBounds().contains(map.markers[i].getPosition())) {
        for (let j = 0; j < legendStats.length; j++) {
          legendStats[j] += Number(map.markers[i].title.split(',')[j]);
        }
      }
    }

    // Update legend values
    const $legendRows = $('.map__legend-row span:first-child i');
    $legendRows.each(function(index) {
      const $this = $(this);
      const currentStat = parseFloat($this.text().replace(/,/g, ''));

      // animate count up when statistic changes based on map bounds
      if ($this.html() !== legendStats[index]) {
        $this.countTo({
          from: currentStat,
          to: legendStats[index],
          speed: 500,
          refreshInterval: 50,
          formatter: function(value, options) {
            value = value.toFixed(options.decimals);
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            return value;
          },
          onUpdate: function(value) {
            console.debug(this);
          },
          onComplete: function(value) {
            console.debug(this);
          }
        });
      }

      // $(this).text(legendStats[index].toLocaleString('en'));
    });
  }

  function removeMarkers(markers) {
    for (let i = 0; i < markers.length; i++) {
      markers[i].setMap(null);
    }
  }

  /*
   *  addMarkers
   *
   *  This function will add markers
   *
   *  @param	$marker (jQuery element)
   *  @param	map (Google Map object)
   *  @return	n/a
   */
  function addMarkers($markers, map) {
    $markers.each(function() {
      const $this = $(this);
      addMarker($this, map);
    });
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
    const latlng = new google.maps.LatLng($marker.data('lat'), $marker.data('lng'));
    const type = $marker.data('type').toLowerCase();

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
      icon: createMarker(icons[type]),
      title: $marker.data('stats').toString()
    });

    // add to array
    map.markers.push(marker);

    // if marker contains HTML, add it to an infoWindow
    if ($marker.html()) {
      // create info window
      let infowindow = new google.maps.InfoWindow({
        content: $marker.html(),
        maxWidth: 400
      });

      // show info window when marker is clicked
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map, marker);
      });

      google.maps.event.addListener(map, 'click', function(event) {
        infowindow.close();
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
  // function centerMap(map) {
  // const bounds = new google.maps.LatLngBounds();
  // loop through all markers and create bounds
  // $.each(map.markers, function(i, marker) {
  //   const latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
  //   bounds.extend(latlng);
  // });
  // const markerCluster = new MarkerClusterer(map, map.markers, {
  //   imagePath:
  //     'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
  // });
  // }

  /* Top location tabs to recenter map */
  function initLocationTabs(map) {
    const $tabs = $('.map__tab');

    $tabs.each(function() {
      $(this).on('click', () => {
        let country = $(this).data('center');

        $tabs.removeClass('mod--active');
        $(this).addClass('mod--active');

        country === 'global' ? map.setZoom(4) : map.setZoom(5);
        map.setCenter(center[country]);
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
