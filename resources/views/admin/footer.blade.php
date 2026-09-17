        </div><!-- /.page-inner -->
    </div><!-- /.content -->
</div><!-- /.main-panel -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleAdminSidebar() {
        document.getElementById('adminSidebar').classList.toggle('show');
        document.getElementById('adminSidebarBackdrop').classList.toggle('show');
    }
    function closeAdminSidebar() {
        document.getElementById('adminSidebar').classList.remove('show');
        document.getElementById('adminSidebarBackdrop').classList.remove('show');
    }
</script>
@stack('scripts')
</body>
</html>
