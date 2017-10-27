(function($){

var $d = $(document);
var $w = $(window);

var canvas;
var header, main, nav, footer;
var title, column, next;
var data = {
  windowWidth: null,
  columnWidth: null,
  timer: null,
  page: 0,
  even: true,
  loading: false
}

$d.ready(function() {
  // jquery setup

  canvas = $("#canvas");

  header = $("#header");
  main = $("#main");
  nav = $("#nav");
  footer = $("footer");

  title = $("#title");


  // event setup

  $w.bottom({
    proximity: 0.001
  }).on("resize", function() {
    clearTimeout(data.timer);
    data.timer = setTimeout(function() {
      updateWidth();
      if(data.page) {
        main.masonry({
          columnWidth: data.columnWidth
        });
      }
    }, 250);
  }).on("bottom", function() {
    clearTimeout(data.timer);
    data.timer = setTimeout(function() {
      if(next.length && !data.loading) {
        data.loading = true;
        infiniteScroll();
      }
    }, 250);
  });

  $d.on("pjax:success", loaded);
  $("[data-pjax] a, a[data-pjax]").on("click", pjaxing);


  // function setup

  function normalize() {
    if(!data.page && main.hasClass("masonry")) {
      main.masonry("destroy");
      data.even = true;
    }

    column = $("#column");
    next = $("#next");
    updateWidth();

    if(column.length) {
      var items = main.find(".item").not(".masonry-brick");
      var sorted = [];

      items.each(function() {
        sorted.push($(this)[0]);
      })
           .remove();

      sorted.sort(function() {
        return Math.random() - Math.random();
      });

      main.append(sorted);

      items = main.find(".item").not(".masonry-brick");
      items.find("[data-pjax] a, a[data-pjax]").on("click", pjaxing);

      for(var i = 0, l = items.length; i < l; i++) {
        var item = items.eq(i);

        item.hover(
          marqueeStart.bind(item),
          marqueeEnd.bind(item)
        );

        if(data.even && 0.8 < Math.random()) {
          item.addClass("x2");
        } else {
          data.even =! data.even;
        }
      }

      if(data.page) {
        main.masonry("option", { isAnimated: false })
            .masonry("appended", items)
            .masonry("option", { isAnimated: true });
      } else {
        main.masonry({
          itemSelector: ".item",
          isAnimated: false,
          isResizable: false,
          columnWidth: data.columnWidth,
          containerStyle: {
            position: "absolute"
          },
          animationOptions: {
            duration: 500,
            easing: "easeOutQuint"
          }
        })
            .masonry()
            .masonry("option", { isAnimated: true });

        data.page++;
      }
    }

    next.appendTo(main);
    column.empty();
  }

  function updateWidth() {
    data.windowWidth = $w.width();
    data.columnWidth = column.width();
  }

  function pjaxing(event) {
    if(!data.loading) {
      event.preventDefault();

      var url = this.href;
      data.page = 0;
      data.loading = true;
      blueUp();

      setTimeout(function() {
        $.pjax({
          url: url,
          container: "#main",
          fragment: "#main",
          timeout: 5000
        });
      }, 500);
    }
  }

  function loaded() {
    main.imagesLoaded(function() {
      setTimeout(function() {
        normalize();
        blueDown();
      }, 250);
    });
  }

  function infiniteScroll() {
    data.page++;
    blueUp();

    setTimeout(function() {
      var url = location.href + "page" + data.page + "/";
      next.remove();

      $.pjax({
        url: url,
        container: "#column",
        fragment: "#main",
        scrollTo: false,
        push: false,
        timeout: 99999
      });
    }, 750);
  }

  $.fn.toggleElement = function() {
    if(this.hasClass("hidden")) {
      this.removeClass("hidden");
    } else {
      this.addClass("hidden");
    }
    return this;
  }

  function marqueeStart() {
    if(!data.loading) {
      var h1 = this.find("h1").text();
      var p = this.find("p").text();
      title.text(h1);
    }
  }

  function marqueeEnd() {
    if(!data.loading) {
      title.text("eilery.com");
    }
  }

  function blueUp() {
    title.text("Loading...");
    canvas.velocity({
        right: 0
      }, {
        duration: 500,
        easing: 'easeInQuint'
      }
    );
  }

  function blueDown() {
    title.text("Loaded.");

    canvas.velocity({
        left: data.windowWidth
      }, {
        duration: 500,
        easing: 'easeOutQuint',
        complete: function() {
          canvas.css("left", "0").css("right", "100%");
          setTimeout(function() {
            data.loading = false;
            title.text("eilery.com");
          }, 250);
        }
      }
    );
  }

  function setup() {
    blueUp();

    setTimeout(function() {
      header.toggleElement();
      main.toggleElement();
      footer.toggleElement();
      nav.toggleElement();

      loaded();
    }, 500);
  }


  // start
  setup();
});

})(jQuery);
