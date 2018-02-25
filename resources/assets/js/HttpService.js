export default {
  makeGetRequest(url, successCallBack, failureCallBack) {
    return new Promise((resolve, reject) => {
        window.axios
        .get(url, {})
        .then(response => {
          if (response.data.success) {
            successCallBack(response);
            resolve(response);
          } else {
            failureCallBack(response);
            reject(response);
          }
        })
        .catch((exception) => {
   /*       Vue.toaster.error('Внутренняя ошибка сервера');*/
          console.log(exception);
        });
    });
  },
  makePostRequest(url, data, successCallBack, failureCallBack) {
    return new Promise((resolve, reject) => {
      window.axios
        .post(url, {
          data,
        })
        .then(response => {
          if (response.data.success) {
            successCallBack(response);
            resolve(response);
          } else {
            failureCallBack(response);
            reject(response);
          }
        })
        .catch(() => {
          Vue.toaster.error('Внутренняя ошибка сервера');
        });
    });
  },
  makeDeleteRequest(url, data, successCallBack, failureCallBack) {
    return new Promise((resolve, reject) => {
      window.axios
        .delete(url, {
          data,
        })
        .then(response => {
          if (response.data.success) {
            successCallBack(response);
            resolve(response);
          } else {
            failureCallBack(response);
            reject(response);
          }
        })
        .catch(() => {
          Vue.toaster.error('Внутренняя ошибка сервера');
        });
    });
  },
  makePutRequest(url, data, successCallBack, failureCallBack) {
    return new Promise((resolve, reject) => {
      window.axios
        .put(url, {
          /* headers: {
            Authorization: authToken,
          }, */
          data,
        })
        .then(response => {
          if (response.data.success) {
            successCallBack(response);
            resolve(response);
          } else {
            failureCallBack(response);
            reject(response);
          }
        })
        .catch(() => {
          Vue.toaster.error('Внутренняя ошибка сервера');
        });
    });
  },
};
