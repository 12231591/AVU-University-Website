<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';
include 'includes/header.php';
?>

<!-- 🎓 Hero Section with YouTube Video Embed -->
<section style="position: relative; height: 100vh; overflow: hidden;">
  <iframe src="https://www.youtube.com/embed/7cwUcdpUayQ?autoplay=1&mute=1&controls=0&loop=1&playlist=7cwUcdpUayQ"
          frameborder="0" allow="autoplay; encrypted-media" allowfullscreen
          style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></iframe>

  <div style="position: absolute; top: 0; left: 0; z-index: 2; width: 100%; height: 100%;
              background: rgba(0, 51, 102, 0.75); display: flex; flex-direction: column;
              justify-content: center; align-items: center; text-align: center; padding: 40px; color: white;">
    <h1 style="font-size: 3.5rem; margin-bottom: 20px;" data-step="1" data-intro="Welcome to AVU with a dynamic video intro.">Welcome to AVU University</h1>
    <p style="font-size: 1.3rem; max-width: 850px; margin-bottom: 30px;">Your gateway to industry-ready education, global collaboration, and real-world innovation. Explore programs, access materials, and connect with staff – all in one platform.</p>
    <div>
      <a href="student_login.php" class="btn" style="background-color: #ffcc00; color: #003366; padding: 12px 24px; border-radius: 6px; font-weight: bold; text-decoration: none;">🎓 Student Login</a>
      <button onclick="startTour()" class="btn" style="margin-left: 15px; padding: 12px 24px; border-radius: 6px; background: white; color: #003366; font-weight: bold;">👁 Tour Website</button>
    </div>
  </div>
</section>

<!-- 🔍 Explore Section -->
<section style="max-width: 1100px; margin: 60px auto; padding: 30px;">
  <h2 data-step="2" data-intro="Navigate to any major part of our university portal." style="text-align:center; margin-bottom: 30px;">Explore AVU Features</h2>
  <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
    <a href="staff.php" class="btn" data-step="3" data-intro="Meet our amazing academic and support staff." style="background: #003366; color: white;">👨‍🏫 Meet Our Staff</a>
    <a href="subjects.php" class="btn" data-step="4" data-intro="Browse through our list of subjects offered." style="background: #0055a5; color: white;">📘 Browse Subjects</a>
    <a href="materials.php" class="btn" data-step="5" data-intro="Access lecture notes, slides, and assignments." style="background: #004080; color: white;">📂 Study Materials</a>
    <a href="forms.php" class="btn" data-step="6" data-intro="Download academic and administrative forms." style="background: #002244; color: white;">📝 Download Forms</a>
    <a href="student_register.php" class="btn" data-step="7" data-intro="Start your AVU journey by registering as a student." style="background: #336699; color: white;">🆕 Register</a>
    <a href="student_login.php" class="btn" data-step="8" data-intro="Login here to access your student dashboard." style="background: #003366; color: white;">🔐 Student Login</a>
    <a href="admin_dashboard.php" class="btn" data-step="9" data-intro="Admin users can manage the platform from here." style="background: #000000; color: white;">🛠 Admin Panel</a>
  </div>
</section>

<!-- 🌟 Why Choose AVU -->
<section style="max-width: 1000px; margin: 60px auto; padding: 30px; background: white; border-radius: 10px; box-shadow: 0 5px 10px rgba(0,0,0,0.05);" data-step="10" data-intro="Here's why students love AVU.">
  <h2 style="text-align: center; margin-bottom: 20px;">Why AVU?</h2>
  <ul style="font-size: 1.1rem; line-height: 1.6;">
    <li>✔ Industry-relevant, accredited courses designed with global standard </li>
    <li>✔ Hands-on project experience and innovation labs</li>
    <li>✔ Accessible learning with online resources and 24/7 support</li>
    <li>✔ Global collaboration through student exchange programs</li>
    <li>✔ Trusted by thousands of students and professionals worldwide</li>
  </ul>
</section>

<!-- ⭐ Highlights -->
<section style="display: flex; flex-wrap: wrap; gap: 25px; justify-content: center; padding: 40px 20px; max-width: 1200px; margin: auto;" data-step="11" data-intro="Our unique features that set us apart from others.">
  <?php
    $highlights = [
      ["🎓", "Accredited Programs", "Globally recognized degrees in key disciplines like Business, Tech & Arts."],
      ["💡", "Innovation & Research", "Cutting-edge labs, AI projects, and startup mentorship embedded in curriculum."],
      ["🌏", "Global Connections", "Partnerships with 50+ institutions across 4 continents for exchange & growth."],
      ["📚", "Smart Study Tools", "AI-powered content suggestions, digital libraries, and seamless materials access."]
    ];
    foreach ($highlights as $h) {
      echo "
        <div style='flex: 1 1 250px; background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.05); text-align: center;'>
          <h3>{$h[0]} {$h[1]}</h3>
          <p>{$h[2]}</p>
        </div>";
    }
  ?>
</section>

<!-- 🚩 Testimonials -->
<section style="max-width: 1000px; margin: 60px auto; padding: 30px;" data-step="12" data-intro="See what students say about their AVU experience.">
  <h2 style="text-align:center; margin-bottom: 20px;">Student Testimonials</h2>
  <blockquote style="font-style: italic; margin-bottom: 10px;">“AVU helped me land my dream internship at a top company. I learned and grew every day.” – <strong>Riya P.</strong></blockquote>
  <blockquote style="font-style: italic;">“The hands-on learning and 24/7 access to resources changed my study habits.” – <strong>Samuel L.</strong></blockquote>
</section>

<!-- 📩 Contact Section -->
<section style="background: #003366; color: white; text-align: center; padding: 50px 20px;" data-step="13" data-intro="Have questions? Contact us for support.">
  <h2>Contact AVU Support</h2>
  <p>We're always ready to assist – whether it's enrollment, tech help, or feedback!</p>
  <a href="mailto:support@avu.edu" style="display: inline-block; margin-top: 15px; background: #ffcc00; color: #003366; padding: 12px 24px; border-radius: 6px; font-weight: bold; text-decoration: none;">📧 Get in Touch</a>
</section>

<!-- Intro.js Script -->
<link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css">
<script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>
<script>
function startTour() {
  introJs().setOptions({
    steps: [
      { intro: "👋 Welcome to AVU University! Let’s take a quick tour of the site." },
      { element: document.querySelector('[data-step="1"]'), intro: "🎥 AVU’s tour video gives you a quick insight into our vibrant campus life." },
      { element: document.querySelector('[data-step="2"]'), intro: "🔍 These links help you explore everything our platform offers." },
      { element: document.querySelector('[data-step="3"]'), intro: "👨‍🏫 Meet our experienced academic and support staff." },
      { element: document.querySelector('[data-step="4"]'), intro: "📘 Browse all subjects and departments available at AVU." },
      { element: document.querySelector('[data-step="5"]'), intro: "📂 Access all your lecture notes and materials from here." },
      { element: document.querySelector('[data-step="6"]'), intro: "📝 Find and download forms for admin tasks." },
      { element: document.querySelector('[data-step="7"]'), intro: "🆕 New here? Register as a student to begin your journey." },
      { element: document.querySelector('[data-step="8"]'), intro: "🔐 Already registered? Login to access your dashboard." },
      { element: document.querySelector('[data-step="9"]'), intro: "🛠 Admins can log in to manage the university’s backend." },
      { element: document.querySelector('[data-step="10"]'), intro: "💬 Why AVU? Here's what makes us different." },
      { element: document.querySelector('[data-step="11"]'), intro: "⭐ Our signature programs and tools at a glance." },
      { element: document.querySelector('[data-step="12"]'), intro: "🗣 Hear what our current and past students say about AVU." },
      { element: document.querySelector('[data-step="13"]'), intro: "📧 Need help or information? Reach out to us anytime." },
      { element: document.querySelector('#ai-chatbot'), intro: "🤖 Need instant help? Use our AI Assistant to get answers 24/7!" }, // 👈 NEW
      { intro: "✅ Tour complete! You're now ready to explore AVU on your own. Good luck!" }
    ]
  }).start();
}

</script>

<?php include 'includes/footer.php'; ?>
