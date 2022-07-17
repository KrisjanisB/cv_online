/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
const {color} = require("tailwindcss/lib/util/dataTypes");

// window.Vue = require('vue').default;
//
// /**
//  * The following block of code may be used to automatically register your
//  * Vue components. It will recursively scan this directory for the Vue
//  * components and automatically register them with their "basename".
//  *
//  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
//  */
//
// // const files = require.context('./', true, /\.vue$/i)
// // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
//
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */
//
// const app = new Vue({
//     el: '#app',
// });

const addNewItemButtons = document.querySelectorAll(".add-new-input");

addNewItemButtons.forEach(function (item) {

    item.addEventListener("click", function () {
        let lastNode = item.previousElementSibling;
        let nr = parseInt(lastNode.dataset.fieldId);
        let clone = lastNode.cloneNode(true);
        clearInputs(clone, nr);
        clone.querySelector(".delete-input").classList.remove("hidden");
        clone.classList.add("mt-4");
        item.before(clone);

    });
});

const wrappers = document.querySelectorAll("[data-field-group]");
wrappers.forEach(function (item) {
    item.addEventListener("click", function (e) {
        if (e.target.classList.contains("delete-input")) {
            e.target.parentElement.parentElement.remove();
        }
    });
});

function clearInputs(clone, nr) {

    clone.querySelectorAll("input, textarea, checkbox, select").forEach(item => {

        if (item.getAttribute("type") === "checkbox") {
            item.checked = false;
        } else if (item.tagName === "SELECT") {
            item.value = "Please Select Appropriate";
        } else {
            item.value = "";
        }
        // Iterate field set key
        item.name = item.name.replace(/\[\d+\]/, `[${nr + 1}]`);
    });
}
