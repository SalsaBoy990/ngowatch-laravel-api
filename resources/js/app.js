import Alpine from 'alpinejs';
import focus from '@alpinejs/focus'

import {data} from "./clean/modules/data";
import {tabsData} from "./clean/modules/tabsData";
import {modalData} from "./clean/modules/modalData";
import {alertData} from './clean/modules/alertData';
import {animateData} from "./clean/modules/animateData";
import {dropdownData} from "./clean/modules/dropdownData";
import {offCanvasMenuData} from "./clean/modules/offCanvasMenuData";


window.Alpine = Alpine;

// enable focus trap extension
Alpine.plugin(focus);

Alpine.data('data', data);
Alpine.data('dropdownData', dropdownData);
Alpine.data('data', data);
Alpine.data('modalData', modalData);
Alpine.data('animateData', animateData);
Alpine.data('alertData', alertData);
Alpine.data('tabsData', tabsData);
Alpine.data('offCanvasMenuData', offCanvasMenuData);

Alpine.start();






