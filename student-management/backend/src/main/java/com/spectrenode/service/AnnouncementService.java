package com.spectrenode.service;

import com.spectrenode.dto.CreateAnnouncementRequest;
import com.spectrenode.model.Announcement;
import com.spectrenode.model.Course;
import com.spectrenode.repository.AnnouncementRepository;
import com.spectrenode.repository.CourseRepository;
import org.springframework.stereotype.Service;

@Service
public class AnnouncementService {

    private final AnnouncementRepository announcementRepository;
    private final CourseRepository courseRepository;

    public AnnouncementService(
            AnnouncementRepository announcementRepository,
            CourseRepository courseRepository) {

        this.announcementRepository = announcementRepository;
        this.courseRepository = courseRepository;
    }

    public Announcement create(
            CreateAnnouncementRequest request) {

        Course course = courseRepository
                .findById(request.getCourseId())
                .orElseThrow();

        Announcement announcement = new Announcement();

        announcement.setTitle(request.getTitle());
        announcement.setMessage(request.getMessage());
        announcement.setCourse(course);

        return announcementRepository.save(announcement);
    }
}