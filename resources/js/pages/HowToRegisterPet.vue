<script setup lang="ts">

import UserLayout from '@/layouts/user/UserLayout.vue';
defineOptions({ layout: UserLayout });
</script>

<template>
    <div class="guide-container">
        <h1>How to register your pet</h1>

        <div class="info-box">
            <p>
                To ensure the best care for your pet, registration is required before accessing our veterinary services. You can either register your
                pet in advance through your account or during the service booking process.
            </p>
        </div>

        <div class="guide-sections">
            <section class="guide-section">
                <h2>How to register a pet during service booking</h2>
                <ol>
                    <li>During the service booking process, you'll reach a 'Pet Information' section.</li>
                    <li>Look for and click the 'Register New Pet' button to open the registration form.</li>
                    <li>Fill in your pet's details carefully, including name, species, breed, and medical history.</li>
                    <li>Review all information and click 'Save' to complete the registration.</li>
                </ol>
            </section>

            <section class="guide-section">
                <h2>Register your pet through your account</h2>
                <ol>
                    <li>Sign in to your account and navigate to the 'Pet Profile' section.</li>
                    <li>Select 'Add Pet' and complete all required information in the registration form.</li>
                    <li>Once saved, your pet will appear in your profile and be available for future bookings.</li>
                </ol>
                <p class="note">Remember to keep your pet's information up to date by regularly reviewing and updating their profile.</p>
            </section>

            <section class="guide-section">
                <h2>Managing registered pets</h2>
                <ol>
                    <li>Access your pet profiles through the 'Pet Profile' section of your account.</li>
                    <li>You can edit information, update medical history, or add vaccination records at any time.</li>
                    <li>For multiple pets, you can easily switch between profiles using the pet selector.</li>
                </ol>
                <p class="note">Important: Please ensure all medical information is accurate and current for the safety of your pet.</p>
            </section>
        </div>
    </div>
</template>

<style scoped>
.guide-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 2rem;
}

h1 {
    color: #333;
    font-size: 2.5rem;
    margin-bottom: 2rem;
}

.info-box {
    background-color: #f0f8ff;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 3rem;
}

.info-box p {
    margin-bottom: 1rem;
    color: #444;
    line-height: 1.6;
}

.info-button {
    display: inline-block;
    background-color: #4682b4;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: opacity 0.3s;
}

.info-button:hover {
    opacity: 0.9;
}

.guide-sections {
    display: flex;
    flex-direction: column;
    gap: 3rem;
}

.guide-section {
    background-color: #f8f9fa;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.guide-section h2 {
    color: #4682b4;
    font-size: 1.4rem;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
}

.guide-section ol {
    padding-left: 1.5rem;
    margin-bottom: 1.5rem;
}

.guide-section li {
    margin-bottom: 1rem;
    color: #444;
    line-height: 1.6;
}

.note {
    color: #666;
    font-style: italic;
    margin-top: 1rem;
}

@media (max-width: 768px) {
    .guide-container {
        padding: 1rem;
    }

    h1 {
        font-size: 2rem;
    }

    .guide-section {
        padding: 1.5rem;
    }
}
</style>
