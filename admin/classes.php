<?php 
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
            <h4 class="fw-bold mb-1 text-dark">Class & Batch Management</h4>
            <p class="text-muted small mb-0">Manage course schedules, room assignments, and class cards.</p>
        </div>

        <div class="d-flex align-items-center gap-3">
            <!-- Search bar -->
            <div class="search-input-group d-none d-sm-block">
                <i class="bi bi-search"></i>
                <input type="text" class="form-control" id="searchClassInput" placeholder="Search course, room, building..." onkeyup="filterClassCards()">
            </div>

            <!-- Add New Class Button (Primary CTA) -->
            <button class="btn btn-primary-custom d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addClassModal">
                <i class="bi bi-plus-lg"></i>
                <span>Add New Class</span>
            </button>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-semibold">Total Classes</span>
                    <div class="stat-icon primary">
                        <i class="bi bi-door-open-fill"></i>
                    </div>
                </div>
                <div class="stat-number mb-2" id="totalClassesCount">6</div>
                <div class="stat-trend up">
                    <i class="bi bi-arrow-up-short"></i>
                    <span>Card view directory</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-semibold">Active Sessions</span>
                    <div class="stat-icon success">
                        <i class="bi bi-broadcast"></i>
                    </div>
                </div>
                <div class="stat-number mb-2">4</div>
                <div class="stat-trend up">
                    <span>In session now</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-semibold">Allocated Rooms</span>
                    <div class="stat-icon info">
                        <i class="bi bi-building"></i>
                    </div>
                </div>
                <div class="stat-number mb-2">12</div>
                <div class="text-muted small">
                    <span>Across 4 campus buildings</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-semibold">Upcoming Batches</span>
                    <div class="stat-icon warning">
                        <i class="bi bi-calendar-event-fill"></i>
                    </div>
                </div>
                <div class="stat-number mb-2">2</div>
                <div class="text-muted small">
                    <span>Starting next month</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Alerts -->
    <div id="classSuccessAlert" class="alert alert-success alert-dismissible fade d-none mb-4" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            <span id="alertMessage">Operation completed successfully!</span>
        </div>
        <button type="button" class="btn-close" onclick="document.getElementById('classSuccessAlert').classList.add('d-none');"></button>
    </div>

    <!-- Filter Pills & Alert Bar -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div class="d-flex gap-2 flex-wrap" id="statusFilterGroup">
            <button class="btn btn-sm btn-dark rounded-pill px-3 active filter-btn" onclick="filterByStatus('all')">All Classes</button>
            <button class="btn btn-sm btn-light border rounded-pill px-3 filter-btn" onclick="filterByStatus('active')">Active</button>
            <button class="btn btn-sm btn-light border rounded-pill px-3 filter-btn" onclick="filterByStatus('upcoming')">Upcoming</button>
            <button class="btn btn-sm btn-light border rounded-pill px-3 filter-btn" onclick="filterByStatus('in-progress')">In Progress</button>
        </div>

        <div class="text-muted small">
            Showing class details in <strong>Card View</strong> (No Table)
        </div>
    </div>


    <!-- CLASS DETAIL CARDS GRID (NO TABLE) -->
    <div class="row g-4" id="classCardsContainer">
        <!-- Class Card 1: Web Development -->
        <div class="col-12 col-md-6 col-xl-4 class-card-wrapper" data-status="active" data-search="web development lesson 2 building b it center room 204 lab fall term">
            <div class="class-detail-card">
                <div>
                    <!-- Header -->
                    <div class="class-card-header">
                        <div class="d-flex align-items-center gap-3">
                            <div class="class-course-badge web">
                                <i class="bi bi-code-slash"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Web Development</h6>
                                <span class="text-muted small">Full-Stack Track</span>
                            </div>
                        </div>
                        <span class="badge-status active">Active</span>
                    </div>

                    <!-- Lesson info -->
                    <div class="mb-3">
                        <div class="fw-semibold text-dark small mb-1">
                            <i class="bi bi-book-half text-primary me-1"></i> Lesson
                        </div>
                        <div class="text-muted small ps-3 border-start border-2 border-primary">
                            Lesson 2: Responsive Frontend Design
                        </div>
                    </div>

                    <!-- Room & Building Details -->
                    <div class="row g-2 mb-3">
                        <div class="col-12">
                            <div class="class-detail-item">
                                <i class="bi bi-building text-primary"></i>
                                <div>
                                    <span class="text-muted small">Building:</span>
                                    <strong class="text-dark">Building B (IT Center)</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="class-detail-item">
                                <i class="bi bi-layers"></i>
                                <div>
                                    <span class="text-muted small">Floor:</span>
                                    <strong class="text-dark">2nd Floor</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="class-detail-item">
                                <i class="bi bi-door-closed"></i>
                                <div>
                                    <span class="text-muted small">Room:</span>
                                    <strong class="text-dark">Room 204 (Lab)</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Term & Time Schedule -->
                    <div class="row g-2 mb-3">
                        <div class="col-12">
                            <div class="class-detail-item">
                                <i class="bi bi-calendar-range text-success"></i>
                                <div>
                                    <span class="text-muted small">Term:</span>
                                    <strong class="text-dark">Fall Term 2026</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="class-detail-item">
                                <i class="bi bi-clock text-warning"></i>
                                <div>
                                    <span class="text-muted small">Time:</span>
                                    <strong class="text-dark">08:00 AM - 09:30 AM</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enrolled Students & Attendance Metrics -->
                    <div class="d-flex align-items-center justify-content-between p-2 rounded bg-light border mb-2">
                        <span class="class-meta-pill students">
                            <i class="bi bi-people-fill"></i>
                            <span id="enrolled-CLS-001">0 Students</span>
                        </span>
                        <span class="class-meta-pill attendance">
                            <i class="bi bi-pie-chart-fill"></i>
                            <span id="rate-CLS-001">-</span>
                        </span>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="pt-3 border-top mt-2">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-light text-muted border">ID: CLS-001</span>
                        <div class="d-flex gap-2">
                            <button class="action-btn" title="Edit Class"><i class="bi bi-pencil"></i></button>
                            <button class="action-btn text-danger" title="Delete Class" onclick="this.closest('.class-card-wrapper').remove();"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn-card-action btn-outline-custom w-50 justify-content-center" onclick="openAddStudentModal('CLS-001', 'Web Development')">
                            <i class="bi bi-person-plus-fill"></i> Add Student
                        </button>
                        <a href="attendance.php?class=web" class="btn-card-action btn-primary-tint w-50 justify-content-center text-decoration-none">
                            <i class="bi bi-calendar-check-fill"></i> Attendance
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Class Card 2: Data Science & AI -->
        <div class="col-12 col-md-6 col-xl-4 class-card-wrapper" data-status="active" data-search="data science ai machine learning lesson 3 building d room 305 studio fall term">
            <div class="class-detail-card">
                <div>
                    <!-- Header -->
                    <div class="class-card-header">
                        <div class="d-flex align-items-center gap-3">
                            <div class="class-course-badge ai">
                                <i class="bi bi-cpu"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Data Science & AI</h6>
                                <span class="text-muted small">Machine Learning Track</span>
                            </div>
                        </div>
                        <span class="badge-status active">Active</span>
                    </div>

                    <!-- Lesson info -->
                    <div class="mb-3">
                        <div class="fw-semibold text-dark small mb-1">
                            <i class="bi bi-book-half text-primary me-1"></i> Lesson
                        </div>
                        <div class="text-muted small ps-3 border-start border-2 border-primary">
                            Lesson 3: Deep Neural Networks
                        </div>
                    </div>

                    <!-- Room & Building Details -->
                    <div class="row g-2 mb-3">
                        <div class="col-12">
                            <div class="class-detail-item">
                                <i class="bi bi-building text-primary"></i>
                                <div>
                                    <span class="text-muted small">Building:</span>
                                    <strong class="text-dark">Building D (Science Wing)</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="class-detail-item">
                                <i class="bi bi-layers"></i>
                                <div>
                                    <span class="text-muted small">Floor:</span>
                                    <strong class="text-dark">3rd Floor</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="class-detail-item">
                                <i class="bi bi-door-closed"></i>
                                <div>
                                    <span class="text-muted small">Room:</span>
                                    <strong class="text-dark">Room 305 (Studio)</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Term & Time Schedule -->
                    <div class="row g-2 mb-3">
                        <div class="col-12">
                            <div class="class-detail-item">
                                <i class="bi bi-calendar-range text-success"></i>
                                <div>
                                    <span class="text-muted small">Term:</span>
                                    <strong class="text-dark">Fall Term 2026</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="class-detail-item">
                                <i class="bi bi-clock text-warning"></i>
                                <div>
                                    <span class="text-muted small">Time:</span>
                                    <strong class="text-dark">10:00 AM - 11:30 AM</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enrolled Students & Attendance Metrics -->
                    <div class="d-flex align-items-center justify-content-between p-2 rounded bg-light border mb-2">
                        <span class="class-meta-pill students">
                            <i class="bi bi-people-fill"></i>
                            <span id="enrolled-CLS-002">0 Students</span>
                        </span>
                        <span class="class-meta-pill attendance">
                            <i class="bi bi-pie-chart-fill"></i>
                            <span id="rate-CLS-002">-</span>
                        </span>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="pt-3 border-top mt-2">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-light text-muted border">ID: CLS-002</span>
                        <div class="d-flex gap-2">
                            <button class="action-btn" title="Edit Class"><i class="bi bi-pencil"></i></button>
                            <button class="action-btn text-danger" title="Delete Class" onclick="this.closest('.class-card-wrapper').remove();"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn-card-action btn-outline-custom w-50 justify-content-center" onclick="openAddStudentModal('CLS-002', 'Data Science & AI')">
                            <i class="bi bi-person-plus-fill"></i> Add Student
                        </button>
                        <a href="attendance.php?class=ai" class="btn-card-action btn-primary-tint w-50 justify-content-center text-decoration-none">
                            <i class="bi bi-calendar-check-fill"></i> Attendance
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Class Card 3: Database Administration -->
        <div class="col-12 col-md-6 col-xl-4 class-card-wrapper" data-status="active" data-search="database administration mysql postgresql lesson 1 building b room 102 fall term">
            <div class="class-detail-card">
                <div>
                    <!-- Header -->
                    <div class="class-card-header">
                        <div class="d-flex align-items-center gap-3">
                            <div class="class-course-badge db">
                                <i class="bi bi-database"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Database Administration</h6>
                                <span class="text-muted small">Data Systems Track</span>
                            </div>
                        </div>
                        <span class="badge-status active">Active</span>
                    </div>

                    <!-- Lesson info -->
                    <div class="mb-3">
                        <div class="fw-semibold text-dark small mb-1">
                            <i class="bi bi-book-half text-primary me-1"></i> Lesson
                        </div>
                        <div class="text-muted small ps-3 border-start border-2 border-primary">
                            Lesson 1: Schema Design & Indexing
                        </div>
                    </div>

                    <!-- Room & Building Details -->
                    <div class="row g-2 mb-3">
                        <div class="col-12">
                            <div class="class-detail-item">
                                <i class="bi bi-building text-primary"></i>
                                <div>
                                    <span class="text-muted small">Building:</span>
                                    <strong class="text-dark">Building B (IT Center)</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="class-detail-item">
                                <i class="bi bi-layers"></i>
                                <div>
                                    <span class="text-muted small">Floor:</span>
                                    <strong class="text-dark">1st Floor</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="class-detail-item">
                                <i class="bi bi-door-closed"></i>
                                <div>
                                    <span class="text-muted small">Room:</span>
                                    <strong class="text-dark">Room 102</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Term & Time Schedule -->
                    <div class="row g-2 mb-3">
                        <div class="col-12">
                            <div class="class-detail-item">
                                <i class="bi bi-calendar-range text-success"></i>
                                <div>
                                    <span class="text-muted small">Term:</span>
                                    <strong class="text-dark">Fall Term 2026</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="class-detail-item">
                                <i class="bi bi-clock text-warning"></i>
                                <div>
                                    <span class="text-muted small">Time:</span>
                                    <strong class="text-dark">01:00 PM - 02:30 PM</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enrolled Students & Attendance Metrics -->
                    <div class="d-flex align-items-center justify-content-between p-2 rounded bg-light border mb-2">
                        <span class="class-meta-pill students">
                            <i class="bi bi-people-fill"></i>
                            <span id="enrolled-CLS-003">0 Students</span>
                        </span>
                        <span class="class-meta-pill attendance">
                            <i class="bi bi-pie-chart-fill"></i>
                            <span id="rate-CLS-003">-</span>
                        </span>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="pt-3 border-top mt-2">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-light text-muted border">ID: CLS-003</span>
                        <div class="d-flex gap-2">
                            <button class="action-btn" title="Edit Class"><i class="bi bi-pencil"></i></button>
                            <button class="action-btn text-danger" title="Delete Class" onclick="this.closest('.class-card-wrapper').remove();"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn-card-action btn-outline-custom w-50 justify-content-center" onclick="openAddStudentModal('CLS-003', 'Database Administration')">
                            <i class="bi bi-person-plus-fill"></i> Add Student
                        </button>
                        <a href="attendance.php?class=db" class="btn-card-action btn-primary-tint w-50 justify-content-center text-decoration-none">
                            <i class="bi bi-calendar-check-fill"></i> Attendance
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Class Card 4: Mobile App Development (Matching User Screenshot) -->
        <div class="col-12 col-md-6 col-xl-4 class-card-wrapper" data-status="active" data-search="mobile app development lesson 4 building c main hall room 402 hall fall term">
            <div class="class-detail-card">
                <div>
                    <!-- Header -->
                    <div class="class-card-header">
                        <div class="d-flex align-items-center gap-3">
                            <div class="class-course-badge mobile">
                                <i class="bi bi-phone"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Mobile App Development</h6>
                                <span class="text-muted small">iOS & Android Track</span>
                            </div>
                        </div>
                        <span class="badge-status active">Active</span>
                    </div>

                    <!-- Lesson info -->
                    <div class="mb-3">
                        <div class="fw-semibold text-dark small mb-1">
                            <i class="bi bi-book-half text-primary me-1"></i> Lesson
                        </div>
                        <div class="text-muted small ps-3 border-start border-2 border-primary">
                            Lesson 4: Final Project
                        </div>
                    </div>

                    <!-- Room & Building Details -->
                    <div class="row g-2 mb-3">
                        <div class="col-12">
                            <div class="class-detail-item">
                                <i class="bi bi-building text-primary"></i>
                                <div>
                                    <span class="text-muted small">Building:</span>
                                    <strong class="text-dark">Building C (Main Hall)</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="class-detail-item">
                                <i class="bi bi-layers"></i>
                                <div>
                                    <span class="text-muted small">Floor:</span>
                                    <strong class="text-dark">4th Floor</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="class-detail-item">
                                <i class="bi bi-door-closed"></i>
                                <div>
                                    <span class="text-muted small">Room:</span>
                                    <strong class="text-dark">Room 402 (Hall)</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Term & Time Schedule -->
                    <div class="row g-2 mb-3">
                        <div class="col-12">
                            <div class="class-detail-item">
                                <i class="bi bi-calendar-range text-success"></i>
                                <div>
                                    <span class="text-muted small">Term:</span>
                                    <strong class="text-dark">Fall Term 2026</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="class-detail-item">
                                <i class="bi bi-clock text-warning"></i>
                                <div>
                                    <span class="text-muted small">Time:</span>
                                    <strong class="text-dark">03:00 PM - 04:30 PM</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enrolled Students & Attendance Metrics -->
                    <div class="d-flex align-items-center justify-content-between p-2 rounded bg-light border mb-2">
                        <span class="class-meta-pill students">
                            <i class="bi bi-people-fill"></i>
                            <span id="enrolled-CLS-004">0 Students</span>
                        </span>
                        <span class="class-meta-pill attendance">
                            <i class="bi bi-pie-chart-fill"></i>
                            <span id="rate-CLS-004">-</span>
                        </span>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="pt-3 border-top mt-2">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-light text-muted border">ID: CLS-004</span>
                        <div class="d-flex gap-2">
                            <button class="action-btn" title="Edit Class"><i class="bi bi-pencil"></i></button>
                            <button class="action-btn text-danger" title="Delete Class" onclick="this.closest('.class-card-wrapper').remove();"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn-card-action btn-outline-custom w-50 justify-content-center" onclick="openAddStudentModal('CLS-004', 'Mobile App Development')">
                            <i class="bi bi-person-plus-fill"></i> Add Student
                        </button>
                        <a href="attendance.php?class=mobile" class="btn-card-action btn-primary-tint w-50 justify-content-center text-decoration-none">
                            <i class="bi bi-calendar-check-fill"></i> Attendance
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD NEW CLASS MODAL (MATCHING SCREENSHOT) -->
    <div class="modal fade class-modal" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between">
                    <h5 class="modal-title mb-0" id="addClassModalLabel">Add New Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addClassForm" onsubmit="handleAddNewClass(event)">
                    <div class="modal-body p-4">
                        <!-- Row 1: Course, Lessons, Status -->
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-4">
                                <label class="form-label form-label-custom">Course</label>
                                <select class="form-select form-select-custom" id="modalCourse" required>
                                    <option value="" selected disabled>Select Course</option>
                                    <option value="Web Development">Web Development</option>
                                    <option value="Mobile App Development">Mobile App Development</option>
                                    <option value="Data Science & AI">Data Science & AI</option>
                                    <option value="Database Administration">Database Administration</option>
                                    <option value="Network Security">Network Security</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label form-label-custom">Lessons</label>
                                <select class="form-select form-select-custom" id="modalLesson" required>
                                    <option value="" selected disabled>Select Lesson</option>
                                    <option value="Lesson 1: Introduction">Lesson 1: Introduction</option>
                                    <option value="Lesson 2: Core Fundamentals">Lesson 2: Core Fundamentals</option>
                                    <option value="Lesson 3: Advanced Concepts">Lesson 3: Advanced Concepts</option>
                                    <option value="Lesson 4: Final Project">Lesson 4: Final Project</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label form-label-custom">Status</label>
                                <select class="form-select form-select-custom" id="modalStatus" required>
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Upcoming">Upcoming</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>

                        <!-- Row 2: Building, Floor, Room -->
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-4">
                                <label class="form-label form-label-custom">Building</label>
                                <select class="form-select form-select-custom" id="modalBuilding" required>
                                    <option value="" selected disabled>Select Building</option>
                                    <option value="Building A (Engineering)">Building A (Engineering)</option>
                                    <option value="Building B (IT Center)">Building B (IT Center)</option>
                                    <option value="Building C (Main Hall)">Building C (Main Hall)</option>
                                    <option value="Building D (Science Wing)">Building D (Science Wing)</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label form-label-custom">Floor</label>
                                <select class="form-select form-select-custom" id="modalFloor" required>
                                    <option value="" selected disabled>Select Floor</option>
                                    <option value="Ground Floor">Ground Floor</option>
                                    <option value="1st Floor">1st Floor</option>
                                    <option value="2nd Floor">2nd Floor</option>
                                    <option value="3rd Floor">3rd Floor</option>
                                    <option value="4th Floor">4th Floor</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label form-label-custom">Room</label>
                                <select class="form-select form-select-custom" id="modalRoom" required>
                                    <option value="" selected disabled>Select Room</option>
                                    <option value="Room 101">Room 101</option>
                                    <option value="Room 102">Room 102</option>
                                    <option value="Room 204 (Lab)">Room 204 (Lab)</option>
                                    <option value="Room 305 (Studio)">Room 305 (Studio)</option>
                                    <option value="Room 402 (Hall)">Room 402 (Hall)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Row 3: Term, Time -->
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-6">
                                <label class="form-label form-label-custom">Term</label>
                                <select class="form-select form-select-custom" id="modalTerm" required>
                                    <option value="" selected disabled>Select Term</option>
                                    <option value="Fall Term 2026">Fall Term 2026</option>
                                    <option value="Spring Term 2026">Spring Term 2026</option>
                                    <option value="Summer Term 2026">Summer Term 2026</option>
                                    <option value="Short Intensive Batch">Short Intensive Batch</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label form-label-custom">Time</label>
                                <select class="form-select form-select-custom" id="modalTime" required>
                                    <option value="" selected disabled>Select Time</option>
                                    <option value="08:00 AM - 09:30 AM">08:00 AM - 09:30 AM</option>
                                    <option value="10:00 AM - 11:30 AM">10:00 AM - 11:30 AM</option>
                                    <option value="01:00 PM - 02:30 PM">01:00 PM - 02:30 PM</option>
                                    <option value="03:00 PM - 04:30 PM">03:00 PM - 04:30 PM</option>
                                    <option value="05:00 PM - 06:30 PM">05:00 PM - 06:30 PM</option>
                                </select>
                            </div>
                        </div>

                        <p class="text-muted small mb-0 mt-3">Please fill all the form before submit</p>
                    </div>

                    <div class="modal-footer border-top py-3 px-4 d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-cancel-modal" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-add-class">Add Class</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END ADD NEW CLASS MODAL -->

    <!-- =========================================================
         ADD STUDENT TO CLASS MODAL
         ========================================================= -->
    <div class="modal fade class-modal" id="addStudentToClassModal" tabindex="-1" aria-labelledby="addStudentToClassModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="modal-title mb-0" id="addStudentToClassModalLabel">Enroll Student in Class</h5>
                        <span class="badge bg-primary-subtle text-primary mt-1" id="addStudentClassSubtitle">Mobile App Development • CLS-004</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addStudentToClassForm" onsubmit="handleAddStudentToClass(event)">
                    <div class="modal-body p-4">
                        <!-- Row 1: Target Class Selector -->
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label class="form-label form-label-custom">Target Class</label>
                                <select class="form-select form-select-custom" id="studentTargetClass" required>
                                    <option value="CLS-001">Web Development (CLS-001) • Room 204 (Lab)</option>
                                    <option value="CLS-002">Data Science & AI (CLS-002) • Room 305 (Studio)</option>
                                    <option value="CLS-003">Database Administration (CLS-003) • Room 102</option>
                                    <option value="CLS-004" selected>Mobile App Development (CLS-004) • Room 402 (Hall)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Row 2: Student Name & Roll ID -->
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-6">
                                <label class="form-label form-label-custom">Student Full Name</label>
                                <input type="text" class="form-control form-select-custom" id="studentName" placeholder="e.g. Alex Johnson" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label form-label-custom">Student ID / Roll No</label>
                                <input type="text" class="form-control form-select-custom" id="studentRoll" placeholder="e.g. STD-2024-001" required>
                            </div>
                        </div>

                        <!-- Row 3: Email Address & Gender -->
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-6">
                                <label class="form-label form-label-custom">Email Address</label>
                                <input type="email" class="form-control form-select-custom" id="studentEmail" placeholder="e.g. alex.j@school.edu" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label form-label-custom">Gender</label>
                                <select class="form-select form-select-custom" id="studentGender" required>
                                    <option value="Female">Female</option>
                                    <option value="Male" selected>Male</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <!-- Row 4: Enrollment Date & Status -->
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-6">
                                <label class="form-label form-label-custom">Enrollment Date</label>
                                <input type="date" class="form-control form-select-custom" id="studentEnrollDate" value="2026-09-16" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label form-label-custom">Enrollment Type</label>
                                <select class="form-select form-select-custom" id="studentEnrollType" required>
                                    <option value="Full-time" selected>Full-time Enrolled</option>
                                    <option value="Part-time">Part-time Enrolled</option>
                                    <option value="Auditing">Auditing / Observer</option>
                                    <option value="Probation">Academic Probation</option>
                                </select>
                            </div>
                        </div>

                        <!-- Row 5: Remarks -->
                        <div class="mb-2">
                            <label class="form-label form-label-custom">Academic Remarks / Notes (Optional)</label>
                            <input type="text" class="form-control form-select-custom" id="studentNotes" placeholder="e.g. Enrolled in class session, advisor approved">
                        </div>
                    </div>

                    <div class="modal-footer border-top py-3 px-4 d-flex justify-content-between">
                        <span class="text-muted small"><i class="bi bi-shield-check text-success"></i> Direct class enrollment</span>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-cancel-modal" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-add-class"><i class="bi bi-person-plus-fill me-1"></i> Add Student to Class</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END ADD STUDENT TO CLASS MODAL -->

        </div>
    </div>
</main>

    <!-- Bootstrap JS Bundle -->
    <script src="assets/js/bootstrap.js"></script>

    <script>
        let classCounter = 5;

        // Clean Roster Store for all classes (starts with 0 students)
        const classRosters = {
            'CLS-001': [],
            'CLS-002': [],
            'CLS-003': [],
            'CLS-004': []
        };

        // Class Metadata Lookup
        const classMetaLookup = {
            'CLS-001': { name: 'Web Development', room: 'Building B • Room 204 (Lab)', badge: 'web', icon: 'bi-code-slash' },
            'CLS-002': { name: 'Data Science & AI', room: 'Building D • Room 305 (Studio)', badge: 'ai', icon: 'bi-cpu' },
            'CLS-003': { name: 'Database Administration', room: 'Building B • Room 102', badge: 'db', icon: 'bi-database' },
            'CLS-004': { name: 'Mobile App Development', room: 'Building C • Room 402 (Hall)', badge: 'mobile', icon: 'bi-phone' }
        };

        // --- ENROLL STUDENT MODAL FUNCTIONS ---
        function openAddStudentModal(classId, className) {
            const selectEl = document.getElementById('studentTargetClass');
            if (selectEl) {
                let found = false;
                for (let i = 0; i < selectEl.options.length; i++) {
                    if (selectEl.options[i].value === classId) {
                        selectEl.selectedIndex = i;
                        found = true;
                        break;
                    }
                }
                if (!found) {
                    const opt = document.createElement('option');
                    opt.value = classId;
                    opt.textContent = `${className} (${classId})`;
                    selectEl.appendChild(opt);
                    selectEl.value = classId;
                }
            }

            document.getElementById('addStudentClassSubtitle').textContent = `${className} • ${classId}`;
            document.getElementById('addStudentToClassForm').reset();

            // Today's date
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('studentEnrollDate').value = today;

            const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('addStudentToClassModal'));
            modal.show();
        }

        function handleAddStudentToClass(event) {
            event.preventDefault();

            const classId = document.getElementById('studentTargetClass').value;
            const name = document.getElementById('studentName').value.trim();
            const roll = document.getElementById('studentRoll').value.trim();
            const email = document.getElementById('studentEmail').value.trim();
            const gender = document.getElementById('studentGender').value;
            const enrollType = document.getElementById('studentEnrollType').value;
            const enrollDate = document.getElementById('studentEnrollDate').value;
            const notes = document.getElementById('studentNotes').value.trim();

            if (!name || !roll || !email) {
                alert('Please fill all student details.');
                return;
            }

            // Check if class roster exists in memory, else initialize
            if (!classRosters[classId]) {
                classRosters[classId] = [];
            }

            // Check if already enrolled in this class
            const existing = classRosters[classId].find(s => s.roll.toLowerCase() === roll.toLowerCase());
            if (existing) {
                alert(`Student with ID ${roll} is already in class ${classId}!`);
                return;
            }

            // Add student directly
            classRosters[classId].push({
                roll: roll,
                name: name,
                email: email,
                gender: gender,
                status: 'present',
                type: enrollType,
                date: enrollDate,
                notes: notes
            });

            // Update card UI enrolled badge
            const enrolledBadge = document.getElementById('enrolled-' + classId);
            if (enrolledBadge) {
                const count = classRosters[classId].length;
                enrolledBadge.textContent = `${count} Student${count === 1 ? '' : 's'}`;
            }

            // Update card rate
            const cardRate = document.getElementById('rate-' + classId);
            if (cardRate) {
                cardRate.textContent = '100% Avg';
            }

            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('addStudentToClassModal'));
            if (modal) modal.hide();

            // Show success alert
            const className = classMetaLookup[classId] ? classMetaLookup[classId].name : classId;
            showClassAlert(`Student <strong>${name} (${roll})</strong> has been successfully added to <strong>${className} (${classId})</strong>!`);
        }

        function showClassAlert(msgHtml) {
            const alertEl = document.getElementById('classSuccessAlert');
            const alertMsg = document.getElementById('alertMessage');
            if (alertEl && alertMsg) {
                alertMsg.innerHTML = msgHtml;
                alertEl.classList.remove('d-none');
                alertEl.classList.add('show');
            }
        }

        // --- ADD NEW CLASS HANDLER ---
        function handleAddNewClass(event) {
            event.preventDefault();

            // Retrieve form values
            const course = document.getElementById('modalCourse').value;
            const lesson = document.getElementById('modalLesson').value;
            const status = document.getElementById('modalStatus').value;
            const building = document.getElementById('modalBuilding').value;
            const floor = document.getElementById('modalFloor').value;
            const room = document.getElementById('modalRoom').value;
            const term = document.getElementById('modalTerm').value;
            const time = document.getElementById('modalTime').value;

            // Choose icon and badge based on course
            let iconClass = 'bi-code-slash';
            let badgeType = 'web';
            if (course.includes('Mobile')) {
                iconClass = 'bi-phone';
                badgeType = 'mobile';
            } else if (course.includes('AI') || course.includes('Data')) {
                iconClass = 'bi-cpu';
                badgeType = 'ai';
            } else if (course.includes('Database')) {
                iconClass = 'bi-database';
                badgeType = 'db';
            } else if (course.includes('Security')) {
                iconClass = 'bi-shield-lock';
                badgeType = 'security';
            }

            // Status styling
            let statusBadgeClass = 'badge-status active';
            let statusKey = 'active';
            if (status.toLowerCase().includes('upcoming')) {
                statusBadgeClass = 'badge-status pending';
                statusKey = 'upcoming';
            } else if (status.toLowerCase().includes('progress')) {
                statusBadgeClass = 'badge-status pending';
                statusKey = 'in-progress';
            } else if (status.toLowerCase().includes('completed')) {
                statusBadgeClass = 'badge-status active';
                statusKey = 'completed';
            }

            const classId = `CLS-00${classCounter++}`;
            const searchIndex = `${course} ${lesson} ${building} ${room} ${term} ${status}`.toLowerCase();

            // Register in metadata & roster
            classMetaLookup[classId] = {
                name: course,
                room: `${building} • ${room}`,
                badge: badgeType,
                icon: iconClass
            };
            classRosters[classId] = [];

            // Add target class option to Add Student modal dropdown
            const targetSelect = document.getElementById('studentTargetClass');
            if (targetSelect) {
                const opt = document.createElement('option');
                opt.value = classId;
                opt.textContent = `${course} (${classId}) • ${room}`;
                targetSelect.appendChild(opt);
            }

            // Build new Card HTML (Card View with Add Student & Attendance Buttons)
            const cardHtml = `
                <div class="col-12 col-md-6 col-xl-4 class-card-wrapper" data-status="${statusKey}" data-search="${searchIndex}">
                    <div class="class-detail-card" style="animation: fadeIn 0.4s ease-in-out;">
                        <div>
                            <div class="class-card-header">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="class-course-badge ${badgeType}">
                                        <i class="bi ${iconClass}"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-0">${course}</h6>
                                        <span class="text-muted small">Academic Track</span>
                                    </div>
                                </div>
                                <span class="${statusBadgeClass}">${status}</span>
                            </div>

                            <div class="mb-3">
                                <div class="fw-semibold text-dark small mb-1">
                                    <i class="bi bi-book-half text-primary me-1"></i> Lesson
                                </div>
                                <div class="text-muted small ps-3 border-start border-2 border-primary">
                                    ${lesson}
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-12">
                                    <div class="class-detail-item">
                                        <i class="bi bi-building text-primary"></i>
                                        <div>
                                            <span class="text-muted small">Building:</span>
                                            <strong class="text-dark">${building}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="class-detail-item">
                                        <i class="bi bi-layers"></i>
                                        <div>
                                            <span class="text-muted small">Floor:</span>
                                            <strong class="text-dark">${floor}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="class-detail-item">
                                        <i class="bi bi-door-closed"></i>
                                        <div>
                                            <span class="text-muted small">Room:</span>
                                            <strong class="text-dark">${room}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-12">
                                    <div class="class-detail-item">
                                        <i class="bi bi-calendar-range text-success"></i>
                                        <div>
                                            <span class="text-muted small">Term:</span>
                                            <strong class="text-dark">${term}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="class-detail-item">
                                        <i class="bi bi-clock text-warning"></i>
                                        <div>
                                            <span class="text-muted small">Time:</span>
                                            <strong class="text-dark">${time}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Enrolled Students & Attendance Metrics -->
                            <div class="d-flex align-items-center justify-content-between p-2 rounded bg-light border mb-2">
                                <span class="class-meta-pill students">
                                    <i class="bi bi-people-fill"></i>
                                    <span id="enrolled-${classId}">0 Students</span>
                                </span>
                                <span class="class-meta-pill attendance">
                                    <i class="bi bi-pie-chart-fill"></i>
                                    <span id="rate-${classId}">100% Avg</span>
                                </span>
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="pt-3 border-top mt-2">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge bg-light text-muted border">ID: ${classId}</span>
                                <div class="d-flex gap-2">
                                    <button class="action-btn" title="Edit Class"><i class="bi bi-pencil"></i></button>
                                    <button class="action-btn text-danger" title="Delete Class" onclick="this.closest('.class-card-wrapper').remove();"><i class="bi bi-trash"></i></button>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn-card-action btn-outline-custom w-50 justify-content-center" onclick="openAddStudentModal('${classId}', '${course}')">
                                    <i class="bi bi-person-plus-fill"></i> Add Student
                                </button>
                                <a href="attendance.php?class=${encodeURIComponent(badgeType)}" class="btn-card-action btn-primary-tint w-50 justify-content-center text-decoration-none">
                                    <i class="bi bi-calendar-check-fill"></i> Attendance
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Prepend new card to the container
            const container = document.getElementById('classCardsContainer');
            container.insertAdjacentHTML('afterbegin', cardHtml);

            // Update class count
            const countEl = document.getElementById('totalClassesCount');
            if (countEl) countEl.textContent = document.querySelectorAll('.class-card-wrapper').length;

            // Show success alert
            showClassAlert(`<strong>Success!</strong> Class for <strong>${course}</strong> in <strong>${room}</strong> (${classId}) has been created.`);

            // Reset form and close modal
            document.getElementById('addClassForm').reset();
            const modalInstance = bootstrap.Modal.getInstance(document.getElementById('addClassModal'));
            if (modalInstance) modalInstance.hide();
        }

        // Live Search Filter
        function filterClassCards() {
            const query = document.getElementById('searchClassInput').value.toLowerCase();
            const cards = document.querySelectorAll('.class-card-wrapper');
            cards.forEach(card => {
                const searchData = card.getAttribute('data-search') || '';
                if (searchData.includes(query)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Status Filter Buttons
        function filterByStatus(status) {
            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(btn => {
                btn.classList.remove('btn-dark', 'active');
                btn.classList.add('btn-light');
            });
            event.currentTarget.classList.remove('btn-light');
            event.currentTarget.classList.add('btn-dark', 'active');

            const cards = document.querySelectorAll('.class-card-wrapper');
            cards.forEach(card => {
                if (status === 'all' || card.getAttribute('data-status') === status) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
