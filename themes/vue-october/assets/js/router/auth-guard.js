import store from "@/js/store";

const guard = (to, from, next) => {
  if(store.getters.getUserAuth) {
    next();
  } else {

    next( '/auth?error=true' )
  }
}
export default guard;