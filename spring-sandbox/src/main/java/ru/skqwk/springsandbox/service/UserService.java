package ru.skqwk.springsandbox.service;

import lombok.RequiredArgsConstructor;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.security.core.userdetails.UserDetailsService;
import org.springframework.security.core.userdetails.UsernameNotFoundException;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;
import ru.skqwk.springsandbox.domain.UserAccount;
import ru.skqwk.springsandbox.dto.UserCredentials;
import ru.skqwk.springsandbox.repo.UserRepository;

@Service
@RequiredArgsConstructor
public class UserService implements UserDetailsService {

  private final UserRepository userRepository;
  private final PasswordEncoder passwordEncoder;

  @Override
  public UserDetails loadUserByUsername(String username) throws UsernameNotFoundException {
    return userRepository
        .findByUsername(username)
        .orElseThrow(
            () ->
                new UsernameNotFoundException(
                    String.format("User with username = %s not found", username)));
  }

  public void save(UserCredentials userCredentials) {
    userRepository.save(
        UserAccount.builder()
            .username(userCredentials.getUsername())
            .password(passwordEncoder.encode(userCredentials.getPassword()))
            .build());
  }
}
