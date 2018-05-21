Vue.component('home', {
    props: ['user'],

    mounted() {
      console.log('HOME_HOME_HOME')
    }

    // ready() {
    //   this.$http.get('/api/test')
    //     .then(response => {
    //       console.log(response.data);
    //     });
    // }
});
