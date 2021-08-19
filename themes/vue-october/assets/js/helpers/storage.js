export function getUserStorage() {
  let user = null;
  if(localStorage.getItem('user')) {
    user = JSON.parse(localStorage.getItem('user'));
  }
  return user;
}

export function setUserStorage(payload) {
  localStorage.setItem('user', JSON.stringify(payload));
}

export function removeUserStorage() {
  if (localStorage.getItem('user')) {
    localStorage.removeItem('user');
  }
}