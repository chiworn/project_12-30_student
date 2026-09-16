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
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="classes.php" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1 rounded-pill px-3 py-1 text-decoration-none shadow-sm">
                    <i class="bi bi-arrow-left"></i> Classes
                </a>
                <h4 class="fw-bold mb-0 text-dark">Student Attendance Management</h4>
            </div>
            <p class="text-muted small mb-0">Record, monitor, and review daily class attendance and student presence.</p>
        </div>

        <div class="d-flex align-items-center gap-3">
            <span class="badge bg-light text-dark border px-3 py-2 fw-semibold d-none d-sm-inline-flex align-items-center gap-2">
                <i class="bi bi-calendar-event text-primary"></i>
                <span id="currentDateDisplay">Today: Sep 14, 2026</span>
            </span>

            <!-- Export Attendance Report -->
            <button class="btn btn-light border d-flex align-items-center gap-2" onclick="alert('Attendance report exported to CSV successfully in demo mode!')">
                <i class="bi bi-download"></i>
                <span class="d-none d-md-inline">Export Log</span>
            </button>

            <!-- Save Attendance CTA -->
            <button class="btn btn-primary-custom d-flex align-items-center gap-2" onclick="saveAttendanceSheet()">
                <i class="bi bi-check2-circle"></i>
                <span>Save Attendance</span>
            </button>
        </div>
    </div>

    <!-- Quick Stats Metric Cards -->
    <div class="row g-3 mb-4">
        <!-- Present Today -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-semibold">Present Today</span>
                    <div class="stat-icon success">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                </div>
                <div class="stat-number mb-2" id="kpiPresent">95.8%</div>
                <div class="stat-trend up">
                    <i class="bi bi-check-circle-fill text-success me-1"></i>
                    <span id="kpiPresentCount">1,368 students present</span>
                </div>
            </div>
        </div>

        <!-- Absent Today -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-semibold">Absences</span>
                    <div class="stat-icon" style="background-color: #fef2f2; color: #ef4444;">
                        <i class="bi bi-person-x-fill"></i>
                    </div>
                </div>
                <div class="stat-number mb-2" id="kpiAbsent">34</div>
                <div class="stat-trend down">
                    <span>2.4% of total enrollment</span>
                </div>
            </div>
        </div>

        <!-- Late Arrivals -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-semibold">Late Arrivals</span>
                    <div class="stat-icon warning">
                        <i class="bi bi-clock-history"></i>
                    </div>
                </div>
                <div class="stat-number mb-2" id="kpiLate">18</div>
                <div class="text-muted small">
                    <span>Tardy logged today</span>
                </div>
            </div>
        </div>

        <!-- Excused Leaves -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-semibold">Excused Leave</span>
                    <div class="stat-icon info">
                        <i class="bi bi-envelope-paper-fill"></i>
                    </div>
                </div>
                <div class="stat-number mb-2" id="kpiExcused">8</div>
                <div class="text-muted small">
                    <span>Approved medical notes</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Feedback Alert -->
    <div id="attendanceSuccessAlert" class="alert alert-success alert-dismissible fade d-none mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <span id="attendanceAlertMessage">Attendance sheet has been saved successfully!</span>
        <button type="button" class="btn-close" onclick="document.getElementById('attendanceSuccessAlert').classList.add('d-none');"></button>
    </div>

    <!-- Class Selector & Live Controls Panel -->
    <div class="content-card mb-4">
        <div class="row g-3 align-items-center">
            <!-- Select Class -->
            <div class="col-12 col-md-4">
                <label class="form-label form-label-custom mb-1">Select Class / Batch</label>
                <select class="form-select form-select-custom" id="classSelectDropdown" onchange="changeClassSession()">
                    <option value="web" selected>Web Development (Section A) • Room 204</option>
                    <option value="ai">Data Science & AI (Section B) • Room 305</option>
                    <option value="db">Database Administration (Section A) • Room 102</option>
                    <option value="mobile">Mobile App Development (Section C) • Room 402</option>
                    <option value="security">Network Security (Section A) • Room 101</option>
                </select>
            </div>

            <!-- Attendance Date -->
            <div class="col-12 col-md-3">
                <label class="form-label form-label-custom mb-1">Attendance Date</label>
                <input type="date" class="form-control form-select-custom" id="attendanceDateInput" value="2026-09-14">
            </div>

            <!-- Quick Action Tools -->
            <div class="col-12 col-md-5 d-flex align-items-end justify-content-md-end gap-2 pt-2 pt-md-0">
                <button class="btn btn-outline-success btn-sm px-3 d-flex align-items-center gap-1" onclick="markAllPresent()">
                    <i class="bi bi-check-all"></i>
                    <span>Mark All Present</span>
                </button>
                <button class="btn btn-outline-secondary btn-sm px-3" onclick="resetAttendanceSheet()">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    <span>Reset</span>
                </button>
            </div>
        </div>

        <!-- Live Session Breakdown Bar -->
        <div class="mt-4 pt-3 border-top">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                <div class="d-flex align-items-center gap-3">
                    <span class="small fw-bold text-dark">Session Summary:</span>
                    <span class="badge bg-success-subtle text-success fw-semibold" id="countBadgePresent">8 Present</span>
                    <span class="badge bg-warning-subtle text-warning fw-semibold" id="countBadgeLate">1 Late</span>
                    <span class="badge bg-danger-subtle text-danger fw-semibold" id="countBadgeAbsent">1 Absent</span>
                    <span class="badge bg-info-subtle text-info fw-semibold" id="countBadgeExcused">0 Excused</span>
                </div>
                <div class="small text-muted" id="sessionRateText">
                    Attendance Rate: <strong>90%</strong>
                </div>
            </div>

            <div class="attendance-rate-bar">
                <div class="bar-segment bg-success" id="barPresent" style="width: 80%;"></div>
                <div class="bar-segment bg-warning" id="barLate" style="width: 10%;"></div>
                <div class="bar-segment bg-danger" id="barAbsent" style="width: 10%;"></div>
                <div class="bar-segment bg-info" id="barExcused" style="width: 0%;"></div>
            </div>
        </div>
    </div>

    <!-- Main Content: Student Attendance Roster List (Cards) -->
    <div class="row g-4">
        <!-- Student Roster Column (8 cols) -->
        <div class="col-12 col-xl-8">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold text-dark mb-0">Student Roster (<span id="totalStudentsCount">10</span> enrolled)</h5>
                
                <!-- Search Student in roster -->
                <div class="search-input-group" style="max-width: 250px;">
                    <i class="bi bi-search"></i>
                    <input type="text" class="form-control form-control-sm" id="searchRosterInput" placeholder="Filter student name..." onkeyup="filterRoster()">
                </div>
            </div>

            <div id="rosterContainer">
                <!-- Student 1 -->
                <div class="attendance-card student-row" data-name="jessica davis std-2024-041">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="student-avatar" style="width: 44px; height: 44px; font-size: 1rem; background-color: #eef2ff; color: #4f46e5;">JD</div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Jessica Davis</h6>
                                <span class="text-muted small">Roll: <strong>STD-2024-041</strong> • jessica.d@school.edu</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="attendance-pill-group">
                                <label>
                                    <input type="radio" name="att_1" value="present" class="attendance-radio-btn" checked onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">P</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_1" value="late" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">L</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_1" value="absent" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">A</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_1" value="excused" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">E</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student 2 -->
                <div class="attendance-card student-row" data-name="ethan miller std-2024-042">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="student-avatar" style="width: 44px; height: 44px; font-size: 1rem; background-color: #e0f2fe; color: #0284c7;">EM</div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Ethan Miller</h6>
                                <span class="text-muted small">Roll: <strong>STD-2024-042</strong> • ethan.m@school.edu</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="attendance-pill-group">
                                <label>
                                    <input type="radio" name="att_2" value="present" class="attendance-radio-btn" checked onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">P</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_2" value="late" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">L</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_2" value="absent" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">A</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_2" value="excused" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">E</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student 3 -->
                <div class="attendance-card student-row" data-name="sophia williams std-2024-043">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="student-avatar" style="width: 44px; height: 44px; font-size: 1rem; background-color: #dcfce7; color: #15803d;">SW</div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Sophia Williams</h6>
                                <span class="text-muted small">Roll: <strong>STD-2024-043</strong> • sophia.w@school.edu</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="attendance-pill-group">
                                <label>
                                    <input type="radio" name="att_3" value="present" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">P</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_3" value="late" class="attendance-radio-btn" checked onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">L</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_3" value="absent" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">A</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_3" value="excused" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">E</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student 4 -->
                <div class="attendance-card student-row" data-name="lucas brown std-2024-044">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="student-avatar" style="width: 44px; height: 44px; font-size: 1rem; background-color: #fef3c7; color: #b45309;">LB</div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Lucas Brown</h6>
                                <span class="text-muted small">Roll: <strong>STD-2024-044</strong> • lucas.b@school.edu</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="attendance-pill-group">
                                <label>
                                    <input type="radio" name="att_4" value="present" class="attendance-radio-btn" checked onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">P</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_4" value="late" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">L</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_4" value="absent" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">A</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_4" value="excused" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">E</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student 5 -->
                <div class="attendance-card student-row" data-name="ava taylor std-2024-045">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="student-avatar" style="width: 44px; height: 44px; font-size: 1rem; background-color: #ede9fe; color: #7c3aed;">AT</div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Ava Taylor</h6>
                                <span class="text-muted small">Roll: <strong>STD-2024-045</strong> • ava.t@school.edu</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="attendance-pill-group">
                                <label>
                                    <input type="radio" name="att_5" value="present" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">P</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_5" value="late" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">L</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_5" value="absent" class="attendance-radio-btn" checked onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">A</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_5" value="excused" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">E</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student 6 -->
                <div class="attendance-card student-row" data-name="noah martinez std-2024-046">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="student-avatar" style="width: 44px; height: 44px; font-size: 1rem; background-color: #fce7f3; color: #be185d;">NM</div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Noah Martinez</h6>
                                <span class="text-muted small">Roll: <strong>STD-2024-046</strong> • noah.m@school.edu</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="attendance-pill-group">
                                <label>
                                    <input type="radio" name="att_6" value="present" class="attendance-radio-btn" checked onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">P</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_6" value="late" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">L</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_6" value="absent" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">A</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_6" value="excused" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">E</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student 7 -->
                <div class="attendance-card student-row" data-name="olivia anderson std-2024-047">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="student-avatar" style="width: 44px; height: 44px; font-size: 1rem; background-color: #e0e7ff; color: #4338ca;">OA</div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Olivia Anderson</h6>
                                <span class="text-muted small">Roll: <strong>STD-2024-047</strong> • olivia.a@school.edu</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="attendance-pill-group">
                                <label>
                                    <input type="radio" name="att_7" value="present" class="attendance-radio-btn" checked onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">P</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_7" value="late" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">L</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_7" value="absent" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">A</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_7" value="excused" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">E</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student 8 -->
                <div class="attendance-card student-row" data-name="liam clark std-2024-048">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="student-avatar" style="width: 44px; height: 44px; font-size: 1rem; background-color: #ccfbf1; color: #0f766e;">LC</div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Liam Clark</h6>
                                <span class="text-muted small">Roll: <strong>STD-2024-048</strong> • liam.c@school.edu</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="attendance-pill-group">
                                <label>
                                    <input type="radio" name="att_8" value="present" class="attendance-radio-btn" checked onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">P</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_8" value="late" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">L</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_8" value="absent" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">A</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_8" value="excused" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">E</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student 9 -->
                <div class="attendance-card student-row" data-name="emma wilson std-2024-049">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="student-avatar" style="width: 44px; height: 44px; font-size: 1rem; background-color: #fae8ff; color: #a21caf;">EW</div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Emma Wilson</h6>
                                <span class="text-muted small">Roll: <strong>STD-2024-049</strong> • emma.w@school.edu</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="attendance-pill-group">
                                <label>
                                    <input type="radio" name="att_9" value="present" class="attendance-radio-btn" checked onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">P</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_9" value="late" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">L</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_9" value="absent" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">A</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_9" value="excused" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">E</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student 10 -->
                <div class="attendance-card student-row" data-name="benjamin hall std-2024-050">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="student-avatar" style="width: 44px; height: 44px; font-size: 1rem; background-color: #fee2e2; color: #b91c1c;">BH</div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Benjamin Hall</h6>
                                <span class="text-muted small">Roll: <strong>STD-2024-050</strong> • benjamin.h@school.edu</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="attendance-pill-group">
                                <label>
                                    <input type="radio" name="att_10" value="present" class="attendance-radio-btn" checked onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">P</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_10" value="late" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">L</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_10" value="absent" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">A</span>
                                </label>
                                <label>
                                    <input type="radio" name="att_10" value="excused" class="attendance-radio-btn" onchange="updateAttendanceMetrics()">
                                    <span class="attendance-btn-label">E</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side Attendance Widgets (4 cols) -->
        <div class="col-12 col-xl-4">
            <!-- Legend Card -->
            <div class="content-card mb-4">
                <div class="content-card-header">
                    <h6 class="fw-bold text-dark mb-0">Attendance Status Legend</h6>
                </div>
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex align-items-center justify-content-between p-2 rounded bg-light">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success px-2 py-1">P</span>
                            <span class="small fw-semibold text-dark">Present</span>
                        </div>
                        <span class="text-muted small">Attending session</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between p-2 rounded bg-light">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-warning text-dark px-2 py-1">L</span>
                            <span class="small fw-semibold text-dark">Late / Tardy</span>
                        </div>
                        <span class="text-muted small">>10 mins delayed</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between p-2 rounded bg-light">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-danger px-2 py-1">A</span>
                            <span class="small fw-semibold text-dark">Absent</span>
                        </div>
                        <span class="text-muted small">Unexcused absence</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between p-2 rounded bg-light">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-info text-white px-2 py-1">E</span>
                            <span class="small fw-semibold text-dark">Excused</span>
                        </div>
                        <span class="text-muted small">Leave with notice</span>
                    </div>
                </div>
            </div>

            <!-- Weekly Trend Widget -->
            <div class="content-card mb-4">
                <div class="content-card-header">
                    <h6 class="fw-bold text-dark mb-0">Weekly Average Rate</h6>
                    <span class="badge bg-success-subtle text-success">This Week</span>
                </div>

                <div class="d-flex flex-column gap-3">
                    <div>
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="fw-medium text-dark">Monday</span>
                            <span class="fw-bold text-success">96%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 96%;"></div>
                        </div>
                    </div>

                    <div>
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="fw-medium text-dark">Tuesday</span>
                            <span class="fw-bold text-success">94%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 94%;"></div>
                        </div>
                    </div>

                    <div>
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="fw-medium text-dark">Wednesday</span>
                            <span class="fw-bold text-success">97%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 97%;"></div>
                        </div>
                    </div>

                    <div>
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="fw-medium text-dark">Thursday</span>
                            <span class="fw-bold text-success">95%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 95%;"></div>
                        </div>
                    </div>

                    <div>
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="fw-medium text-dark">Friday</span>
                            <span class="fw-bold text-warning">91%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: 91%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Advisory Warnings -->
            <div class="content-card">
                <div class="content-card-header">
                    <h6 class="fw-bold text-dark mb-0">Attendance Alerts</h6>
                    <span class="badge bg-danger-subtle text-danger">Action Required</span>
                </div>

                <div class="notice-item" style="border-left-color: #ef4444;">
                    <div class="fw-bold small text-dark">Ava Taylor (STD-2024-045)</div>
                    <div class="text-muted small" style="font-size: 0.78rem;">
                        Logged 3 unexcused absences this month. Advisory notice has been prepared for advisor.
                    </div>
                </div>

                <div class="notice-item" style="border-left-color: #f59e0b;">
                    <div class="fw-bold small text-dark">Sophia Williams (STD-2024-043)</div>
                    <div class="text-muted small" style="font-size: 0.78rem;">
                        4 late check-ins recorded. Class counselor follow-up suggested.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</main>

    <!-- Bootstrap JS Bundle -->
    <script src="assets/js/bootstrap.js"></script>

    <!-- Attendance Interactive Logic -->
    <script>
        function updateAttendanceMetrics() {
            const rows = document.querySelectorAll('.student-row');
            let presentCount = 0;
            let lateCount = 0;
            let absentCount = 0;
            let excusedCount = 0;

            rows.forEach(row => {
                const checkedRadio = row.querySelector('.attendance-radio-btn:checked');
                if (checkedRadio) {
                    const val = checkedRadio.value;
                    if (val === 'present') presentCount++;
                    else if (val === 'late') lateCount++;
                    else if (val === 'absent') absentCount++;
                    else if (val === 'excused') excusedCount++;
                }
            });

            const total = rows.length;
            const rate = total > 0 ? Math.round(((presentCount + lateCount * 0.5) / total) * 100) : 0;

            // Update badge counts
            document.getElementById('countBadgePresent').textContent = `${presentCount} Present`;
            document.getElementById('countBadgeLate').textContent = `${lateCount} Late`;
            document.getElementById('countBadgeAbsent').textContent = `${absentCount} Absent`;
            document.getElementById('countBadgeExcused').textContent = `${excusedCount} Excused`;
            document.getElementById('sessionRateText').innerHTML = `Attendance Rate: <strong>${rate}%</strong>`;

            // Update bar widths
            document.getElementById('barPresent').style.width = `${(presentCount / total) * 100}%`;
            document.getElementById('barLate').style.width = `${(lateCount / total) * 100}%`;
            document.getElementById('barAbsent').style.width = `${(absentCount / total) * 100}%`;
            document.getElementById('barExcused').style.width = `${(excusedCount / total) * 100}%`;
        }

        function markAllPresent() {
            const rows = document.querySelectorAll('.student-row');
            rows.forEach(row => {
                const presentRadio = row.querySelector('.attendance-radio-btn[value="present"]');
                if (presentRadio) {
                    presentRadio.checked = true;
                }
            });
            updateAttendanceMetrics();
        }

        function resetAttendanceSheet() {
            markAllPresent();
        }

        function saveAttendanceSheet() {
            const classSelect = document.getElementById('classSelectDropdown');
            const className = classSelect.options[classSelect.selectedIndex].text;
            const dateVal = document.getElementById('attendanceDateInput').value;

            const alertEl = document.getElementById('attendanceSuccessAlert');
            const alertMsg = document.getElementById('attendanceAlertMessage');
            alertMsg.innerHTML = `<strong>Success!</strong> Attendance for <strong>${className}</strong> on <strong>${dateVal}</strong> has been saved.`;
            alertEl.classList.remove('d-none');
            alertEl.classList.add('show');

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function filterRoster() {
            const query = document.getElementById('searchRosterInput').value.toLowerCase();
            const rows = document.querySelectorAll('.student-row');
            rows.forEach(row => {
                const searchData = row.getAttribute('data-name');
                if (searchData.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function changeClassSession() {
            const alertEl = document.getElementById('attendanceSuccessAlert');
            alertEl.classList.add('d-none');
            markAllPresent();
        }

        // Initialize on load with URL query parameter support
        document.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);
            const classParam = params.get('class');
            if (classParam) {
                const select = document.getElementById('classSelectDropdown');
                const p = classParam.toLowerCase();
                for (let i = 0; i < select.options.length; i++) {
                    const optVal = select.options[i].value.toLowerCase();
                    const optText = select.options[i].text.toLowerCase();
                    if (optVal === p || optText.includes(p) || 
                       (p.includes('004') || p.includes('mobile')) && optVal === 'mobile' ||
                       (p.includes('001') || p.includes('web')) && optVal === 'web' ||
                       (p.includes('002') || p.includes('ai')) && optVal === 'ai' ||
                       (p.includes('003') || p.includes('db')) && optVal === 'db') {
                        select.selectedIndex = i;
                        break;
                    }
                }

                // Show active class banner
                const selectedText = select.options[select.selectedIndex].text;
                const alertEl = document.getElementById('attendanceSuccessAlert');
                const alertMsg = document.getElementById('attendanceAlertMessage');
                if (alertEl && alertMsg) {
                    alertMsg.innerHTML = `<i class="bi bi-info-circle me-1"></i> Viewing attendance session for <strong>${selectedText}</strong>.`;
                    alertEl.className = 'alert alert-info alert-dismissible fade show mb-4';
                    alertEl.classList.remove('d-none');
                }
            }
            updateAttendanceMetrics();
        });
    </script>
</body>
</html>
