// https://stackoverflow.com/questions/60144575/how-do-you-handle-click-outside-of-element-properly-in-vuejs
const clickOutside = {
    mounted: function mounted(el, binding, vnode) {
        el.clickOutsideEvent = function (event) {

            //  check that click was outside the el and his children
            if (!(el == event.target || el.contains(event.target))) {
                // vnode.context[binding.expression](event);
                // and if it did, call method provided in attribute value
                binding.value(event, el);
            }
        };
        document.addEventListener("click", el.clickOutsideEvent);
    },
    unmounted: function unmounted(el) {
        document.removeEventListener("click", el.clickOutsideEvent);
    }
};

export default clickOutside;
