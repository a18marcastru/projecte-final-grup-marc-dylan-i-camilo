import { createRouter, createWebHistory } from "vue-router";
import Inicio from "../views/InicioView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: Inicio,

    },
    {
      path: "/register",
      name: "register",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/RegisterView.vue"),

    },
    {
      path: "/login",
      name: "login",
      component: () => import("../views/LoginView.vue"),
    }
  ],
});

export default router;
