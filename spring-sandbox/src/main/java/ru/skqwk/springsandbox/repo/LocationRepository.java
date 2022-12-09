package ru.skqwk.springsandbox.repo;

import org.springframework.data.jpa.repository.JpaRepository;
import ru.skqwk.springsandbox.domain.Location;

public interface LocationRepository extends JpaRepository<Location, Long> {
}
