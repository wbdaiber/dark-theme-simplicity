
<?php
/*
Template Name: Contact Page
*/

get_header();
?>

<div id="contact-page-root"></div>

<script>
// Initialize React
const root = ReactDOM.createRoot(document.getElementById('contact-page-root'));
root.render(React.createElement(ContactPageWP));
</script>

<?php
get_footer();
?>
