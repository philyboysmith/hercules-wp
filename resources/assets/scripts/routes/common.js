export default {
  init() {
    $('#menuNav').on('click', function(){
      $('#menu').slideToggle();
    });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
