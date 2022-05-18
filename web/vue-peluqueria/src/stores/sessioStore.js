import { defineStore } from "pinia";

export const sessioStore = defineStore("sessio", {
    state: () => ({
        sessio: {},
    }),
    getters: {
        get() {
            return this.sessio;
        }
    },
    actions: {
        set(s) {
            this.sessio = s;
        },
    }
});