<?php
/*
🎯 Practice Scenario: Media Conversion System
Let’s say you want to build a Media Converter (e.g., converting video files from one format to another). The system might internally use several complex subsystems like:

Audio extractor

Video compressor

Format encoder

Metadata editor

You can create a facade that simplifies access to all these subsystems with a clean interface like:

php
Copy
Edit
MediaConverter::convert('example.mov', 'mp4');
✅ Components to Build
Subsystems (simulate them with dummy logic):

AudioExtractor

VideoCompressor

FormatEncoder

MetadataEditor

Facade Class:

MediaConverter — a class that simplifies the usage of all the above.

Client Code:

Something that calls MediaConverter::convert() and gets the result.

🧱 Suggested File Structure
bash
Copy
Edit
/app
  /Services
    /Media
      AudioExtractor.php
      VideoCompressor.php
      FormatEncoder.php
      MetadataEditor.php
      MediaConverter.php  <-- The Facade
🧪 Bonus Challenge
If you want to make it more real:

Add simple logging to each subsystem (echo or Log::info()).

Let MediaConverter::convert($file, $format) support multiple formats.

Allow optional metadata update.

*/

class AudioExtractor
{
    public function extract($file)
    {
        return "Audio extracted from $file";
    }
}

class VideoCompressor
{
    public function compress($file)
    {
        return "Video compressed for $file";
    }
}

class FormatEncoder
{
    public function encode($file, $format)
    {
        return "File $file encoded to $format format";
    }
}

class MediaConverter
{
    private $audioExtractor;
    private $videoCompressor;
    private $formatEncoder;

    public function __construct()
    {
        $this->audioExtractor = new AudioExtractor();
        $this->videoCompressor = new VideoCompressor();
        $this->formatEncoder = new FormatEncoder();
    }

    public function convert($file, $format)
    {
        $audio = $this->audioExtractor->extract($file);
        $video = $this->videoCompressor->compress($file);
        $encodedFile = $this->formatEncoder->encode($file, $format);

        return "$audio, $video, and $encodedFile";
    }
}

function clientCode()
{
    $converter = new MediaConverter();
    $result = $converter->convert('example.mov', 'mp4');
    echo $result;
}

clientCode();