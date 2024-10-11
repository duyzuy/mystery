/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
window.Vue = require('vue');

// import VueI18n from 'vue-i18n';
// Vue.use(VueI18n)
// import slug from 'slug';

// import Vue from 'vue';
// import VueCarousel from 'vue-carousel';

// Vue.use(VueCarousel);


// window.Slug = require('slug');
// Slug.defaults.mode = "rfc3986"

  
import Buefy from 'buefy';



Vue.use(Buefy, {
    // defaultIconComponent: 'vue-fontawesome',
    defaultIconPack: 'fas',
});
require('./frontend/header');




Vue.config.productionTip = false;




Vue.component('restaurants', require('./components/RestaurentComponent.vue').default);
Vue.component('b-receipt', require('./components/ReceiptInputComponent.vue').default);
