package ru.skqwk.springsandbox.service;

import org.springframework.stereotype.Service;

import javax.imageio.ImageIO;
import java.awt.*;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;

@Service
public class WatermarkService extends ImageService{
  private static final String WATERMARK = PATH + "watermark" + "." + IMAGE_TYPE;
  private static int WATERMARK_X_POS = 20;
  private static int WATERMARK_Y_POS = 0;

  public void addWatermark(String sourceFileNameWithType) throws IOException {
    String sourceFilePath = PATH + sourceFileNameWithType;
    BufferedImage image = ImageIO.read(new File(sourceFilePath));
    BufferedImage overlay = ImageIO.read(new File(WATERMARK));

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
    ImageIO.write(watermarked, IMAGE_TYPE, new File(sourceFilePath));
    w.dispose();
  }
}
