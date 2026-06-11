package com.spectrenode.controller;

import com.spectrenode.dto.profile.ProfileRequest;
import com.spectrenode.model.StudentProfile;
import com.spectrenode.service.StudentProfileService;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/profile")
public class StudentProfileController {

    private final StudentProfileService profileService;

    public StudentProfileController(
            StudentProfileService profileService) {

        this.profileService = profileService;
    }

    @PostMapping("/{userId}")
    public StudentProfile createProfile(
            @PathVariable Long userId,
            @RequestBody ProfileRequest request) {

        return profileService
                .createProfile(userId, request);
    }

    @GetMapping("/{userId}")
    public StudentProfile getProfile(
            @PathVariable Long userId) {

        return profileService
                .getProfile(userId);
    }
}