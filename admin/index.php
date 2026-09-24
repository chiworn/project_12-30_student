<?php
session_start();

if (file_exists('./Sidebar.php')) {
    include('./Sidebar.php');
} else {
    include(__DIR__ . '/Sidebar.php');
}
?>

<div class="col-12 col-md-9 col-lg-10 main-content">

    <!-- Welcome Section -->
    <div style="background-color: #0D1C42;" class="p-4 p-md-5 mb-4 rounded-4  text-white">
        <div class="row align-items-center">

            <div class="col-md-8">
                <span class="badge bg-white text-primary mb-3">
                    Student Management System
                </span>

                <h1 class="fw-bold mb-3">
                    Welcome to My System
                </h1>

                <p class="mb-4 opacity-75">
                    A simple student management system UI designed to
                    organize student information, classes, courses,
                    and academic records.
                </p>

                <button class="btn btn-light px-4">
                    <i class="bi bi-people me-2"></i>
                    View Students
                </button>
            </div>

            <div class="col-md-4 text-center d-none d-md-block">
                <i class="bi bi-mortarboard-fill"
                   style="font-size: 120px;"></i>
            </div>

        </div>
    </div>


    <!-- System Features -->
    <div class="mb-4">
        <h4 class="fw-bold text-dark mb-1">
            System Overview
        </h4>

        <p class="text-muted">
            Main features of the Student Management System
        </p>
    </div>


    <div class="row g-4 mb-4">

        <!-- Students -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <div class="bg-primary-subtle text-primary
                                rounded-3 d-flex align-items-center
                                justify-content-center mb-3"
                         style="width:50px;height:50px;">

                        <i class="bi bi-people-fill fs-4"></i>
                    </div>

                    <h5 class="fw-bold">Students</h5>

                    <p class="text-muted small">
                        Manage and view student information.
                    </p>

                    <a href="#" class="text-primary text-decoration-none">
                        View Students →
                    </a>

                </div>
            </div>
        </div>


        <!-- Classes -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <div class="bg-success-subtle text-success
                                rounded-3 d-flex align-items-center
                                justify-content-center mb-3"
                         style="width:50px;height:50px;">

                        <i class="bi bi-building fs-4"></i>
                    </div>

                    <h5 class="fw-bold">Classes</h5>

                    <p class="text-muted small">
                        View available classes and sections.
                    </p>

                    <a href="#" class="text-success text-decoration-none">
                        View Classes →
                    </a>

                </div>
            </div>
        </div>


        <!-- Courses -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <div class="bg-warning-subtle text-warning
                                rounded-3 d-flex align-items-center
                                justify-content-center mb-3"
                         style="width:50px;height:50px;">

                        <i class="bi bi-book-fill fs-4"></i>
                    </div>

                    <h5 class="fw-bold">Courses</h5>

                    <p class="text-muted small">
                        View courses and academic subjects.
                    </p>

                    <a href="#" class="text-warning text-decoration-none">
                        View Courses →
                    </a>

                </div>
            </div>
        </div>


        <!-- Reports -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <div class="bg-info-subtle text-info
                                rounded-3 d-flex align-items-center
                                justify-content-center mb-3"
                         style="width:50px;height:50px;">

                        <i class="bi bi-bar-chart-fill fs-4"></i>
                    </div>

                    <h5 class="fw-bold">Reports</h5>

                    <p class="text-muted small">
                        View student and academic reports.
                    </p>

                    <a href="#" class="text-info text-decoration-none">
                        View Reports →
                    </a>

                </div>
            </div>
        </div>

    </div>


    <!-- Student Management Introduction -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body p-4 p-md-5">

            <div class="row align-items-center">

                <div class="col-md-8">

                    <h4 class="fw-bold mb-3">
                        About Student Management
                    </h4>

                    <p class="text-muted">
                        Student Management System is designed to help
                        organize student information in one place.
                        It provides a simple interface for viewing
                        students, classes, courses, and academic
                        information.
                    </p>

                    <div class="row mt-4">

                        <div class="col-sm-6 mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Student Information
                        </div>

                        <div class="col-sm-6 mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Class Management
                        </div>

                        <div class="col-sm-6 mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Course Information
                        </div>

                        <div class="col-sm-6 mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Academic Reports
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</div>
</div>
</main>

<script src="assets/js/bootstrap.js"></script>

</body>
</html>