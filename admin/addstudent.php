<?php 
session_start();
$userid = $_SESSION['id'];

if(!isset($_SESSION["id"]) && $_SESSION["id"] == '') {
    echo "No session ... ";
}

if (file_exists('./Sidebar.php')) {
    include ('./Sidebar.php');
} else {
    include (__DIR__ . '/Sidebar.php');
}
?>
<div class="col-12 col-md-9 col-lg-10 main-content">
    <!-- Top Bar Navigation -->
    <div class="top-navbar d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
        <div>
           <h4 class="fw-bold mb-1 text-dark">
            Student  & Batch Management (Class ID: <?= htmlspecialchars($_SESSION['id'] ?? 'Guest') ?>)
        </h4>
            <p class="text-muted small mb-0">Manage course schedules, room assignments, and class cards.</p>
        </div>

        <div class="d-flex align-items-center gap-3">
        </div>
    </div>

    <form id="addStudentForm" action="" method="POST">

    <div class="modal-body p-4">
        <!-- Row 1: First Name, Last Name, Email -->
        <div class="row g-3 mb-3">

            <div class="col-12 col-md-4">
                <label class="form-label form-label-custom">
                    First Name
                </label>
                <input type="text"
                       class="form-control form-control-custom"
                       name="first_name"
                       placeholder="Enter first name"
                       required>
            </div>

            <div class="col-12 col-md-4">
                <label class="form-label form-label-custom">
                    Last Name
                </label>
                <input type="text"
                       class="form-control form-control-custom"
                       name="last_name"
                       placeholder="Enter last name"
                       required>
            </div>

            <div class="col-12 col-md-4">
                <label class="form-label form-label-custom">
                    Email
                </label>
                <input type="email"
                       class="form-control form-control-custom"
                       name="email"
                       placeholder="Enter email"
                       required>
            </div>

        </div>

        <!-- Row 2: Gender, Date of Birth, Status -->
        <div class="row g-3 mb-3">

            <div class="col-12 col-md-4">
                <label class="form-label form-label-custom">
                    Gender
                </label>

                <select class="form-select form-select-custom"
                        name="gender"
                        required>

                    <option value="" selected disabled>
                        Select Gender
                    </option>

                    <option value="Male">Male</option>
                    <option value="Female">Female</option>

                </select>
            </div>


            <div class="col-12 col-md-4">
                <label class="form-label form-label-custom">
                    Date of Birth
                </label>

                <input type="date"
                       class="form-control form-control-custom"
                       name="dob"
                       required>
            </div>


            <div class="col-12 col-md-4">
                <label class="form-label form-label-custom">
                    Status
                </label>

                <select class="form-select form-select-custom"
                        name="status"
                        required>

                    <option value="" selected disabled>
                        Select Status
                    </option>

                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>

                </select>
            </div>

        </div>


        <!-- Row 3: Class -->
        <div class="row g-3 mb-3">

            <div class="col-12">

                <label class="form-label form-label-custom">
                    Class
                </label>

                <select class="form-select form-select-custom"
                        name="class_id"
                        required>

                    <option value="" selected disabled>
                        Select Class
                    </option>

                    <option value="CLS-001">
                        CLS-001 - Web Development
                    </option>

                    <option value="CLS-002">
                        CLS-002 - Mobile App Development
                    </option>

                    <option value="CLS-003">
                        CLS-003 - Data Science & AI
                    </option>

                </select>

            </div>

        </div>

        <p class="text-muted small mb-0 mt-3">
            Please fill all the form before submit
        </p>

    </div>


    <!-- Footer -->
    <div class="modal-footer border-top py-3 px-4
                d-flex justify-content-end gap-2">

        <button type="button"
                class="btn btn-cancel-modal">
            Cancel
        </button>

        <button type="submit"
                class="btn btn-add-class btn-primary">
            Add Student
        </button>

    </div>

</form>

 
        </div>
    </div>
</main>

    <!-- Bootstrap JS Bundle -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
