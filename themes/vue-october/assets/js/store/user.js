import axios from "axios";
import router from "@/js/router/routes";
import { getUserStorage, setUserStorage, removeUserStorage } from "@/js/helpers/storage";

const user = {
  state: () => ({
    user: null,
    token: "",
    error: null
  }),
  mutations: {
    SET_USER(state, payload) {
      state.user = payload;
    },
    SET_TOKEN(state, payload) {
      state.token = payload;
    },
    SET_ERROR(state, payload) {
      state.error = payload;
    }
  },
  actions: {
    registerUser({ commit}, data) {
      axios.post("/api/signup", data)
      .then(response => {
        const data = response.data;
        commit("SET_TOKEN", data.token);
        commit("SET_USER", data.user);
        setUserStorage(data.user);
        router.push({ name: "account" })
      })
      .catch(function (error) {
        const data = error.toJSON();
        console.log(data.message);
        commit("SET_ERROR", "Данный E-mail уже занят!");
      })
    },
    loginUser({ commit}, data) {
      axios.post("/api/login", data)
      .then(response => {
        const data = response.data;
        commit("SET_TOKEN", data.token);
        commit("SET_USER", data.user);
        setUserStorage(data.user);
        router.push({ name: "account" })
      })
      .catch(function (error) {
        const data = error.toJSON();
        console.log(data.message);
        commit("SET_ERROR", "Неверный логин или пароль!");
      });
    },
    autoLogin({ commit}) {
      const user = getUserStorage();
      if(user) {
        commit("SET_TOKEN", user);
        commit("SET_USER", user);
      }
    },
    logoutUser({ commit}) {
      commit("SET_TOKEN", null);
      commit("SET_USER", null);
      removeUserStorage();
      router.push({ name: "auth", query: { logout: 'true' } });
    },
    setError({commit}, data) {
      commit("SET_ERROR", data);
    }
  },
  getters: {
    getAuthError(state) {
      return state.error;
    },
    getUserAuth(state) {
      return state.user;
    },
    getToken(state) {
      return state.token;
    }
  }
}
export default user;