package ru.skqwk.springsandbox.controller;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;

@Controller
public class DocumentsViewController {

    public String documents(Model model) {
        return "documents";
    }

}
