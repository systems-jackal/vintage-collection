package com.spectrenode.repository;

import com.spectrenode.model.Enrollment;
import org.springframework.data.jpa.repository.JpaRepository;

public interface EnrollmentRepository
        extends JpaRepository<Enrollment, Long> {
}