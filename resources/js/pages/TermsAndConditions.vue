<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
defineOptions({ layout: UserLayout });
</script>

<template>
    <div class="terms-container">
        <h1>Terms & Conditions</h1>

        <div class="terms-section">
            <section>
                <h2>1. Acceptance of Terms</h2>
                <p>
                    By accessing and using PawPal's services, you agree to be bound by these terms and conditions. These terms apply to all veterinary
                    services, pet care services, and related activities provided by our clinic.
                </p>
            </section>

            <section>
                <h2>2. Service Agreement</h2>
                <ul>
                    <li>All services are provided by qualified veterinary professionals</li>
                    <li>Appointments must be scheduled in advance unless in emergency situations</li>
                    <li>We reserve the right to refuse service at our discretion</li>
                    <li>Emergency services may incur additional charges</li>
                </ul>
            </section>

            <section>
                <h2>3. Payment Terms</h2>
                <ul>
                    <li>Payment is required at the time of service</li>
                    <li>We accept cash and gcash only</li>
                    <li>Special payment arrangements must be agreed upon in advance</li>
                    <li>Additional fees may apply for after-hours services</li>
                </ul>
            </section>

            <section>
                <h2>4. Pet Owner Responsibilities</h2>
                <ul>
                    <li>Provide accurate medical history and information</li>
                    <li>Ensure pets are properly restrained during visits</li>
                    <li>Follow prescribed treatment plans and medication schedules</li>
                    <li>Notify staff of any behavioral issues or concerns</li>
                </ul>
            </section>

            <section>
                <h2>5. Medical Records</h2>
                <ul>
                    <li>All medical records remain property of PawPal</li>
                    <li>Copies can be provided upon written request</li>
                    <li>Information is kept confidential as per privacy laws</li>
                    <li>Records may be shared with other veterinary facilities when necessary</li>
                </ul>
            </section>

            <section>
                <h2>6. Cancellation Policy</h2>
                <ul>
                    <li>24-hour notice required for appointment cancellations</li>
                    <li>
                        Late cancellations (beyond 24 hours) will incur a 7% fee from the total service cost, with the remaining amount eligible for
                        refund
                    </li>
                    <li>Repeated no-shows may affect future booking privileges</li>
                </ul>
            </section>

            <section>
                <h2>7. Liability</h2>
                <p>
                    While we strive to provide the best possible care, we cannot guarantee specific outcomes. Pet owners acknowledge that there are
                    inherent risks in medical treatments and procedures.
                </p>
            </section>

            <section>
                <h2>8. Changes to Terms</h2>
                <p>
                    We reserve the right to modify these terms at any time. Continued use of our services following any changes constitutes acceptance
                    of the new terms.
                </p>
            </section>
        </div>

        <div class="contact-info">
            <p>For questions about these terms, please contact us at:</p>
            <p>Phone: 099110992</p>
            <p>Email: peppapets.ph@gmail.com</p>
        </div>
    </div>
</template>

<style scoped>
.terms-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 2rem;
}

h1 {
    color: #333;
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}

.last-updated {
    color: #666;
    margin-bottom: 3rem;
    font-style: italic;
}

.terms-section {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

section {
    background-color: #f8f9fa;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

h2 {
    color: #4682b4;
    font-size: 1.4rem;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
}

p {
    color: #444;
    line-height: 1.6;
    margin-bottom: 1rem;
}

ul {
    list-style: disc;
    padding-left: 1.5rem;
    color: #444;
    line-height: 1.6;
}

li {
    margin-bottom: 0.5rem;
}

.contact-info {
    margin-top: 3rem;
    padding: 2rem;
    background-color: #f0f8ff;
    border-radius: 8px;
    text-align: center;
}

.contact-info p {
    margin-bottom: 0.5rem;
}

@media (max-width: 768px) {
    .terms-container {
        padding: 1rem;
    }

    h1 {
        font-size: 2rem;
    }

    section {
        padding: 1.5rem;
    }
}
</style>
