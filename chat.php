<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$search_word = isset($_GET['search_word']) ? strtolower($_GET['search_word']) : '';
$directory = 'concord/'; // Update this with the actual path to your directory
$searchWords = explode(' ', $search_word);

// Read the stop words file into an array
$sw = file('Jil_stop_words.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Split the user input into an array of words
$user_split = $searchWords;

// Remove any whitespace from the stop words
$sw = array_map(function ($string) {
    return preg_replace('/\s/', '', $string);
}, $sw);

$user_filtered = [];
$user_sw = [];

foreach ($user_split as $word) {
    // Check if the lowercase word is in the stop words array
    if (in_array(strtolower($word), $sw)) {
        $user_sw[] = $word;
    } else {
        $user_filtered[] = $word;
    }
}

$files = [];
foreach ($user_filtered as $word) {
    $word = strtolower($word);
    $foundFiles = glob($directory . "*.txt");
    foreach ($foundFiles as $file) {
        if (stripos($file, $word) !== false) { // Case-insensitive search
            $files[] = $file;
        }
    }
}

$files = array_unique($files);

$fileNames = array();
foreach ($files as $file) {
    $fileName = basename($file);
    $fileNames[] = strtolower($fileName); // Convert file names to lowercase
}

$total_files = count($files); // Calculate the total number of files
$currentFileIndex = isset($_GET['index']) ? intval($_GET['index']) : 0;
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>©2023 Wahy Chat Results by Muhammad.com since 1984 before Google</title>
    <style>
        body {
            font-size: 50px; /* Set the desired font size */
        }
        h2 {
            font-size: 50px; /* Set the desired font size */
        }
        h3 {
            font-size: 50px; /* Set the desired font size */
        }
        input {
            font-size: 50px;
        }
        #cw {
            /* font-size: 30px; /* Set the desired font size */
            white-space: pre-wrap; /* Preserve spaces and break lines at spaces */
            max-width: 50ch; /* Limit characters to about 50 per line */
            width: 500px;
            max-height: 250px;
            height: 250px;
            overflow: auto;
            border: 1px solid #ccc;
            padding: 10px;
            font-family: sans-serif;
        }
    </style>
</head>
<body class="html not-front not-logged-in no-sidebars page-node page-node- page-node-216 node-type-crmland i18n-en section-crmland">

<!-- above search submit is here -->

Allah.com Muhammad.com: Mecca Browser, Madina Safe Kids Browser, APPs 130 Languages<br>
<img src="banner.jpg" width="100%" height="90"><br>
Welcome to Qur'an & Hadith (Wahy) Chat<br>
Example of asking about "Hell & Paradise".<br>

<!-- There is ## references from Qur'an and Hadith (Wahy)
|paradise | paradises | hell | hells|
[Hell & Paradise      ]
Next
blah blah
next
-->

<p>There are <?php echo $total_files; ?> references from Qur'an and Hadith (Wahy in 3 Languages, be patient we will seperate later)</p>

<div style="font-size: 15px;">
    <?php
        foreach ($fileNames as $f) {
            echo $f . ' | ';
        } 
    ?>
</div>

<form method="GET" action="">
    <input type="text" name="search_word" value="<?php echo htmlspecialchars($search_word, ENT_QUOTES, 'UTF-8'); ?>"  value="Hell & Paradise" style="width: 600px; height: 50px;">
    <br><input type="submit" value="Click to ask and look underneath | Klik untuk bertanya dan lihat ke bawah |انقر للسؤال وانظر في الأسفل">
</form>

<!-- placeholder="Ask any Qur'an and Hadith question in English or Bahasa Indonesian, Arabic, 108 languages coming soon" -->

<?php if (!empty($search_word)): ?>
    <?php if (count($files) > 0): ?>
        <?php if ($currentFileIndex >= 0 && $currentFileIndex < count($files)): ?>
            <?php
            $file = $files[$currentFileIndex];

            $fileName = $fileNames[$currentFileIndex];

            $fileContent = file_get_contents($file);

            // Remove empty lines from the beginning of the file
            $fileContent = preg_replace('/^\s*[\r\n]/m', '', $fileContent);

            $lines = preg_split('/(?<=\p{Arabic})(?=\p{Latin})|(?<=\p{Latin})(?=\p{Arabic})/', $fileContent);
            ?>

            <?php if ($currentFileIndex > 0): ?>
                <a href="?search_word=<?php echo urlencode($search_word); ?>&index=<?php echo $currentFileIndex - 1; ?>">Previous</a>
            <?php endif; ?>

            <?php if ($currentFileIndex < count($files) - 1): ?>
                <a href="?search_word=<?php echo urlencode($search_word); ?>&index=<?php echo $currentFileIndex + 1; ?>">Next</a>
            <?php endif; ?>

            <h3><?php echo htmlspecialchars($fileName, ENT_QUOTES, 'UTF-8'); ?></h3>
            <?php foreach ($lines as $line): ?>
                <?php if (!empty(trim($line))): ?>
                    <div id="cw">
                        <?php echo htmlspecialchars($line, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if ($currentFileIndex > 0): ?>
                <a href="?search_word=<?php echo urlencode($search_word); ?>&index=<?php echo $currentFileIndex - 1; ?>">Previous</a>
            <?php endif; ?>

            <?php if ($currentFileIndex < count($files) - 1): ?>
                <a href="?search_word=<?php echo urlencode($search_word); ?>&index=<?php echo $currentFileIndex + 1; ?>">Next</a>
            <?php endif; ?>

        <?php else: ?>
            <p>Invalid index.</p>
        <?php endif; ?>
    <?php else: ?>
        <p>No such words in Qur'an and hadith <p>If the question is a non Wahy then ask us here: <a href="https://poe.com/GeneralNonWahyChat"  target="_blank">General Non Wahy Chat</a></p>
        '<?php echo htmlspecialchars($search_word, ENT_QUOTES, 'UTF-8'); ?>'.</p>
    <?php endif; ?>
<?php else: ?>
    <p>Ask a Wahy words question.</p>
<?php endif; ?>

<!-- dad edit from here below -->

<p>On the spiritual occasion of Happy Birthday, O Nabi, Salam be upon you, we are excited to release the 1st WahyChat. Alhamdulillah, no one else has our Authentic Prophetic Inherited City of Knowledge Data Warehouse, by our teachers; Azhar's head of department professors. Enjoy!
Please register <a href="https://muhammad.com/get_started2.php" target="_blank">to continue and to be able to download the references of answers</a> Alhamdulillah, we have over 100,000 Qur'an (Actually Kor'an) and Hadith AI Data Warehouse Bank of our own preparing since 1984 both in authenticity and contemporary English. We do not look or search on the Internet. If you'd like to reach for us and or help<br>
<a href="https://wa.me/+6285785117147" target="_blank">Chat with us now.</a><br>
<a href="https://muhammad.com/" target="_blank">Learn via unique 6 hours labs of all unique arabic of Qur'an in 30 minutes at time</a>
<p><a href="https://muhammad.com/Azhar.pdf" target="_blank">Our Unique Curriculum of Sahaba EduWay by our teachers; Azhar's head of department professors</a></p>

<p>" I ask forgiveness from Allah, Christianity is spreading because they are more generous than Muslims, they usually give 20% of their monthly income to the church and they forge 4 Bibles by unknown authors  (due to the loss of Jesus’ own book) though they are translated into 2500 languages because of the generous Christians. On the other hand, most Muslims are greedy and do not volunteer or provide any assistance. And those who try to help are often contacted by Dawa Party's undercover scammers. We are trying to make the Qur’an available in 130 languages, everyone wants money to do any proofreading etc!”

<p>(1) Zakat, both obligatory and extra zakat for orphans in villages in Pasuruan, Indonesia. Send money to the Qur'an volunteer teacher and Orphan manager: PayPal.Me: hamidahjamiatul@gmail.com | Click: <a href="https://paypal.me/orphanyatim?country.x=ID&locale.x=en_US">https://paypal.me/orphanyatim?country.x=ID&locale.x=en_US</a>
<p>(2) Gift/hadia for the 6 (-2) full-time volunteering team - running house, electricity, high-speed wifi, hardware, etc., including food, serving: Allah.com, Muhammad.com, Mosque.com, and the University, send money to: PayPal.Me: allahcommuhammadcom@gmail.com | Click: <a href="https://paypal.me/aisyahfatima?country.x=ID&locale.x=en_US">https://paypal.me/aisyahfatima?country.x=ID&locale.x=en_US</a>
<p>This marks the first occasion in 41 years, dating back to 1981, when we find ourselves compelled to inquire. This necessity has arisen because we have sadly lost two members from our original team of six. Additionally, one of our team members, who is currently 73 years old, feeling that he will be departing soon, but he is doing so with contentment and happiness. الحمد لله الذي لا حاجة له في عذاب اي من هذا الفريق واللهم اختم لنا بالإيمان وبارك فى كل من يساعدنا </p>
<h2>©2023 Wahy Chat Results by Muhammad.com since 1984 before Google Ask in Arabic or English or Bahasa Indonesia more than 108 languages coming soon inshaAllah:</h2>
</body>
</html>
