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
        clone.dataset.fieldId = nr + 1;
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

const eductionLevelSelect = document.querySelector("#education");
const fieldGroups = document.querySelectorAll("[data-field-group]");
const event = new Event("change");
fieldGroups.forEach(function (fieldGroup) {
    const groupType = fieldGroup.dataset.fieldGroup;

    fieldGroup.addEventListener("change", function (e) {

        // check education level, show appropriate fields
        if (e.target.classList.contains("higher-education-select")) {
            const selectEl = e.target;
            const educationLevel = selectEl.value;
            const id = selectEl.getAttribute("name").split("[")[1].split("]")[0];

            const fieldSet = fieldGroup.querySelector("[data-field-id=\"" + id + "\"]");
            const inputs = fieldSet.querySelectorAll(".higher-education");

            if (educationLevel === "Basic" || educationLevel === "Secondary") {
                inputs.forEach(function (item) {
                    item.classList.add("hidden");
                    item.disabled = true;
                    item.required = false;
                });
            } else {
                inputs.forEach(function (item) {
                    item.classList.remove("hidden");
                    item.disabled = false;
                    item.required = true;
                });
            }

        }


        // if work or education is active, disable end_date input
        if (e.target.classList.contains("is_active")) {
            const checkEl = e.target;
            const id = checkEl.getAttribute("name").split("[")[1].split("]")[0];
            const fieldSet = fieldGroup.querySelector("[data-field-id=\"" + id + "\"]");
            const endDate = fieldSet.querySelector("[name=\"" + groupType + "[" + id + "][end_date]\"]");
            const isActive = checkEl.checked;

            if (isActive) {
                endDate.classList.add("hidden");
                endDate.disabled = true;
            } else {
                endDate.classList.remove("hidden");
                endDate.disabled = false;
            }
        }
    });
});

if(document.querySelector('.close-alert')){
    document.querySelector('.close-alert').addEventListener("click", function () {
        document.querySelector('.alert').classList.add("hidden");
    });
}



