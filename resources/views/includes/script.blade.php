<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('assets/js/scripts.js')}}"></script>

        <script>
document.addEventListener("DOMContentLoaded", function() {
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
                entry.target.classList.add('slide-in');
            }
        });
    });

    document.querySelectorAll('.post-preview').forEach(section => {
        observer.observe(section);
    });

    observer.observe(document.querySelector('.recent-posts-header'));
});
</script>
