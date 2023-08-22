/* import the fontawesome core */
import {library} from '@fortawesome/fontawesome-svg-core';

/* import specific icons */
import {
    faUserSecret,
    faSignInAlt,
    faHome,
    faUser,
    faSignOutAlt,
    faBars,
    faTimes,
    faCaretDown,
    faChevronUp,
    faCaretRight,
    faChevronLeft,
    faChevronRight,
    faAngleDoubleLeft,
    faAngleDoubleRight,
    faSearch,
    faPlus,
    faMinus,
    faTrash,
    faPencilAlt,
    faQuestionCircle,
    faCircleCheck,
    faDashboard,
    faExclamationTriangle,
    faExclamationCircle,
    faInfoCircle,
    faAngleRight, faImages
} from '@fortawesome/free-solid-svg-icons';
import {faCog} from "@fortawesome/free-solid-svg-icons/faCog";

/* add icons to the library */
library.add(
    faUserSecret, faSearch, faSignInAlt, faSignOutAlt, faHome, faUser, faBars, faTimes, faCaretDown,
    faCaretRight, faChevronUp, faChevronLeft, faChevronRight, faAngleDoubleLeft, faAngleDoubleRight,
    faPlus, faMinus, faTrash, faPencilAlt, faQuestionCircle, faDashboard, faPlus, faMinus, faExclamationTriangle,
    faExclamationCircle, faCircleCheck, faInfoCircle, faAngleRight, faCog, faImages
);

export default library;
