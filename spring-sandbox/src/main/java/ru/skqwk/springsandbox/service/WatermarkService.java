package ru.skqwk.springsandbox.service;

import org.springframework.stereotype.Service;

import javax.imageio.ImageIO;
import java.awt.*;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;

@Service
public class WatermarkService extends ImageService{
  private static final String WATERMARK = "watermark";
  private static int WATERMARK_X_POS = 20;
  private static int WATERMARK_Y_POS = 0;

  public WatermarkService(DocumentService documentService) {
    super(documentService);
  }

  public String addWatermark(String fileName) throws IOException {
    BufferedImage image = getImage(fileName);
    BufferedImage overlay = getImage(WATERMARK);

    // determine image type and handle correct transparency
    BufferedImage watermarked =
        new BufferedImage(image.getWidth(), image.getHeight(), BufferedImage.TYPE_INT_ARGB);

    // initializes necessary graphic properties
    Graphics2D w = (Graphics2D) watermarked.getGraphics();
    w.drawImage(image, 0, 0, null);
    AlphaComposite alphaChannel = AlphaComposite.getInstance(AlphaComposite.SRC_OVER, 0.4f);
    w.setComposite(alphaChannel);

    // add text watermark to the image
    w.drawImage(overlay, WATERMARK_X_POS, WATERMARK_Y_POS, null);
    saveImage(fileName, watermarked);
    w.dispose();
    return getImageHref(fileName);
  }
}
