window.spacelampsix.post = window.spacelampsix.post || {};
window.spacelampsix.post.edit = window.spacelampsix.post.edit || {};

window.spacelampsix.post.edit = {

    boot: function () {
        /**
         * Set the markdown content in Toast
         */
        spacelampsix.toast.setMarkdown($('#post-body').val());

        /**
         * Alert that updating the post to "featured", will un-feature their current post.
         */
        $('#featured_checkbox').on('click', () => {
            confirm('Are you sure you want to make this post featured? It will "un-feature" your current featured post.');
        });

        /**
         * On form submission, set the "body" field with the Toast markdown content
         */
        $('#update-post-form').on('submit', (event) => {
            event.preventDefault();
            document.querySelector('#content').value = spacelampsix.toast.getMarkdown();
            event.target.submit();
        });
    }

}