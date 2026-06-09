package com.spectrenode.service;

import com.spectrenode.dto.DashboardResponse;
import com.spectrenode.repository.AssignmentRepository;
import com.spectrenode.repository.AnnouncementRepository;
import com.spectrenode.repository.CourseRepository;
import com.spectrenode.repository.EnrollmentRepository;
import org.springframework.stereotype.Service;

@Service
public class DashboardService {

    private final CourseRepository courseRepository;
    private final AssignmentRepository assignmentRepository;
    private final AnnouncementRepository announcementRepository;
    private final EnrollmentRepository enrollmentRepository;

    public DashboardService(
            CourseRepository courseRepository,
            AssignmentRepository assignmentRepository,
            AnnouncementRepository announcementRepository,
            EnrollmentRepository enrollmentRepository) {

        this.courseRepository = courseRepository;
        this.assignmentRepository = assignmentRepository;
        this.announcementRepository = announcementRepository;
        this.enrollmentRepository = enrollmentRepository;
    }

    public DashboardResponse getDashboard() {

        DashboardResponse response =
                new DashboardResponse();

        response.setTotalCourses(
                courseRepository.count());

        response.setTotalAssignments(
                assignmentRepository.count());

        response.setTotalAnnouncements(
                announcementRepository.count());

        response.setTotalEnrollments(
                enrollmentRepository.count());

        return response;
    }
}