package ru.skqwk.springsandbox.controller;

import com.fasterxml.jackson.databind.ObjectMapper;
import jakarta.servlet.http.HttpServletResponse;
import org.springframework.http.MediaType;
import org.springframework.web.bind.annotation.ExceptionHandler;
import ru.skqwk.springsandbox.dto.ErrorResponse;
import ru.skqwk.springsandbox.exception.ResourceNotFoundException;

import java.io.IOException;
import java.io.OutputStream;

public class BaseApiController {

  @ExceptionHandler(ResourceNotFoundException.class)
  void handleNotFound(HttpServletResponse response, Exception exception) throws IOException {
    sendResponse(response, HttpServletResponse.SC_NOT_FOUND, exception);
  }

  @ExceptionHandler(IllegalStateException.class)
  void handleIllegalState(HttpServletResponse response, IllegalStateException exception)
      throws IOException {
    sendResponse(response, HttpServletResponse.SC_BAD_REQUEST, exception);
  }

  @ExceptionHandler(IllegalArgumentException.class)
  void handleIllegalArgument(HttpServletResponse response, IllegalArgumentException exception)
      throws IOException {
    sendResponse(response, HttpServletResponse.SC_BAD_REQUEST, exception);
  }

  void sendResponse(HttpServletResponse response, int status, Exception exception)
      throws IOException {
    OutputStream out = response.getOutputStream();
    ObjectMapper mapper = new ObjectMapper();
    ErrorResponse error =
        ErrorResponse.builder().code(status).message(exception.getMessage()).build();
    response.setStatus(status);
    response.setContentType(MediaType.APPLICATION_JSON_VALUE);
    mapper.writeValue(out, error);
    out.flush();
  }
}
