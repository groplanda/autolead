export function onValidate(arrayErrors, form) {
  let errors = [];

  for(let errorKey in arrayErrors) {
    if(Array.isArray(arrayErrors[errorKey])) {
      // eslint-disable-next-line no-prototype-builtins
      if(form.hasOwnProperty(errorKey)) {
        arrayErrors[errorKey].forEach(err => {
          errors.push({name: errorKey, message: err})
        })
      }
    }
  }

  return errors;
}

export function checkErr(prop, errors) {
  let msg = '';
  errors.forEach(err => {
    if(err.name === prop || prop.indexOf(err.name) !== -1) {
        msg = err.message;
    }
  })
  return msg;
}

export function createFormData(keys, data) {
  let formData = new FormData();
  keys.forEach(item => {
    if (Array.isArray(data[item.key])) {
      data[item.key].forEach((element, index) => {
        if (element[0] instanceof File || element instanceof File) {
          const file = element[0] ? element[0] : element;
          if (file) formData.append(`${item.key}[${index}]`, file);
        } else {
          formData.append(item.key, JSON.stringify(data[item.key]));
        }
      });
    } else {
      formData.append(item.key, data[item.key]);
    }
  });
  return formData;
}

export function createFormState(data, imageField) {
  let form = {
    items: {},
    gallery: []
  };
  for(let key in data) {
    // eslint-disable-next-line no-prototype-builtins
    if(data.hasOwnProperty(key)) {
      if(imageField === key && (data[key] && data[key].path)) {
        form.gallery.push(data[key].path);
      }
      form.items[key] = data[key]
    }
  }
  return form;
}

export function fillForm(data, keys) {
  const form = {};
  keys.forEach(item => {
    form[item.key] = data[item] ? data[item.key] : item.default;
  })
  return form;
}