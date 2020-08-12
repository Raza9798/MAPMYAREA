import Vue from "vue";
import VueRouter from "vue-router";

import Home from "../views/Home.vue";
import TRAVEL from "../views/TRAVEL.vue";
import CREG from "../views/CREG.vue"; 
import NotFound from "../views/404.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/travel",
    name: "TRAVEL",
    component: TRAVEL,
  },
  {
    path: "/creg",
    name: "CREG",
    component: CREG,
  }, 
  {
    path: "*",
    name: "NotFound",
    component: NotFound,
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
