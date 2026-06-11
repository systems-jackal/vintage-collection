package com.spectrenode.service;

import com.spectrenode.dto.profile.ProfileRequest;
import com.spectrenode.model.StudentProfile;
import com.spectrenode.model.User;
import com.spectrenode.repository.StudentProfileRepository;
import com.spectrenode.repository.UserRepository;
import org.springframework.stereotype.Service;

@Service
public class StudentProfileService {

    private final StudentProfileRepository profileRepository;
    private final UserRepository userRepository;

    public StudentProfileService(
            StudentProfileRepository profileRepository,
            UserRepository userRepository) {

        this.profileRepository = profileRepository;
        this.userRepository = userRepository;
    }

    public StudentProfile createProfile(
            Long userId,
            ProfileRequest request) {

        User user = userRepository.findById(userId)
                .orElseThrow(() ->
                        new RuntimeException("User not found"));

        StudentProfile profile =
                new StudentProfile();

        profile.setUser(user);
        profile.setAdmissionNumber(
                request.getAdmissionNumber());
        profile.setFaculty(
                request.getFaculty());
        profile.setDepartment(
                request.getDepartment());
        profile.setPhoneNumber(
                request.getPhoneNumber());
        profile.setYearOfStudy(
                request.getYearOfStudy());

        return profileRepository.save(profile);
    }

    public StudentProfile getProfile(
            Long userId) {

        return profileRepository
                .findByUserId(userId)
                .orElseThrow(() ->
                        new RuntimeException(
                                "Profile not found"));
    }
}