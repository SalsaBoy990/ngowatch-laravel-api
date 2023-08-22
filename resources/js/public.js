import Alpine from 'alpinejs';

import {data} from "./clean/modules/data";
import {dropdownData} from "./clean/modules/dropdownData";
import {offCanvasMenuData} from "./clean/modules/offCanvasMenuData";

// Image viewer / gallery
import lightGallery from "lightgallery";
window.lightGallery = lightGallery;

// Plugins for the image gallery
import lgThumbnail from "lightgallery/plugins/thumbnail";
window.lgThumbnail = lgThumbnail;
import lgZoom from "lightgallery/plugins/zoom";
window.lgZoom = lgZoom;


window.Alpine = Alpine;

Alpine.data('data', data);
Alpine.data('dropdownData', dropdownData);
Alpine.data('offCanvasMenuData', offCanvasMenuData);

Alpine.start();


const photoGalleryContainer = document.querySelector("#lightgallery");
if (photoGalleryContainer) {
    const photoGalleryInstance = lightGallery(photoGalleryContainer, {
        plugins: [window.lgZoom, window.lgThumbnail],
    });

    const openGalleryButton = document.querySelector(
        "#open-light-gallery-button"
    );
    if (openGalleryButton) {
        openGalleryButton.addEventListener("click", function () {
            photoGalleryInstance.openGallery(0);
        });
    }
}





