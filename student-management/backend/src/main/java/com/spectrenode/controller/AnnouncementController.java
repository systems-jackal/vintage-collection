package com.spectrenode.controller;

import com.spectrenode.dto.CreateAnnouncementRequest;
import com.spectrenode.model.Announcement;
import com.spectrenode.repository.AnnouncementRepository;
import com.spectrenode.service.AnnouncementService;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/announcements")
public class AnnouncementController {

    private final AnnouncementService announcementService;
    private final AnnouncementRepository announcementRepository;

    public AnnouncementController(
            AnnouncementService announcementService,
            AnnouncementRepository announcementRepository) {

        this.announcementService = announcementService;
        this.announcementRepository = announcementRepository;
    }

    @PostMapping
    public Announcement create(
            @RequestBody CreateAnnouncementRequest request) {

        return announcementService.create(request);
    }

    @GetMapping
    public List<Announcement> getAll() {
        return announcementRepository.findAll();
    }
}