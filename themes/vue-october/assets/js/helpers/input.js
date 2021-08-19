export function toggleInputType(e) {
  const target = e.target,
        input = target.previousElementSibling,
        activeBtnClassName = "form__show-password--active";
        target.classList.toggle(activeBtnClassName);

  if (target.classList.contains(activeBtnClassName)) {
    input.type = "text";
  } else {
    input.type = "password";
  }
}
