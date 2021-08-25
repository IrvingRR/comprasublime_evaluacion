class MDSlider {
    constructor() {
        this.slider_active = 0;
        this.elements = 0; 
        this.items = document.getElementsByClassName("md-slider-item");
        this.elements = this.items.length - 1;
        this.init();
    }

    init() {
        let md_slider_nav_prev = document.getElementById("md_slider_nav_prev");
        let md_slider_nav_next = document.getElementById("md_slider_nav_next");
        
        md_slider_nav_prev ? md_slider_nav_prev.addEventListener("click", function(){this.navigation('prev')}.bind(this)) : null;
        md_slider_nav_next ? md_slider_nav_next.addEventListener("click", function(){this.navigation('next')}.bind(this)) : null;
    }

    show() {
        let pos, i;
        
        for (let i = 0; i < this.items.length; i++) {
            pos = i * 100;
            this.items[i].style.left = pos+'%';
            this.items[i].style.display = 'flex';
        }
    }

    navigation(action) {
        if (action == "prev") {
            if (this.slider_active > 0) {
                this.slider_active = this.slider_active - 1;
                let i, pos;
                for (let i = 0; i < this.items.length; i++) {
                    pos = parseInt(this.items[i].style.left) + 100;
                    this.items[i].style.left = pos+'%';
                }
            }
        }

        if (action == "next") {
            if (this.slider_active < this.elements) {
                this.slider_active = this.slider_active + 1;
                let i, pos;
                for (let i = 0; i < this.items.length; i++) {
                    pos = parseInt(this.items[i].style.left) - 100;
                    this.items[i].style.left = pos+'%';
                }
            }
        }
    }
}