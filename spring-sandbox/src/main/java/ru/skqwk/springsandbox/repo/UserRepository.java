package ru.skqwk.springsandbox.repo;

import org.springframework.data.jpa.repository.JpaRepository;
import ru.skqwk.springsandbox.domain.UserAccount;

import java.util.Optional;

public interface UserRepository extends JpaRepository<UserAccount, Long> {
    Optional<UserAccount> findByUsername(String username);
}
