<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
</script>

<template>
    <UserLayout>
        <div class="prescription-container">
            <div class="header-section">
                <h1>Prescription Regulations</h1>
                <p class="subtitle">Information about ordering prescription medicines from PawPal</p>
            </div>

            <div class="content-section">
                <div class="info-block">
                    <h2>Prescription Only Medicines (POM-V)</h2>
                    <p>By law, POM-V medicines can only be supplied upon receipt of a valid prescription from your veterinary surgeon.</p>
                    <p>Your prescription must be an original document and signed by your vet. We cannot accept photocopies or faxed prescriptions.</p>
                </div>

                <div class="info-block">
                    <h2>Written Prescriptions</h2>
                    <p>Your vet is obliged by law to provide you with a written prescription on request. They may charge for this service.</p>
                    <p>A prescription is valid for 6 months from the date of issue for most medicines.</p>
                </div>

                <div class="info-block">
                    <h2>Prescription Requirements</h2>
                    <ul>
                        <li>Pet owner's name and address</li>
                        <li>Animal's name, species, age and weight</li>
                        <li>Name, strength and quantity of the drug</li>
                        <li>Dosage and administration instructions</li>
                        <li>Date of prescription issue</li>
                        <li>Vet's signature and practice details</li>
                    </ul>
                </div>

                <div class="info-block">
                    <h2>Important Information</h2>
                    <ul>
                        <li>We must receive your prescription before we can dispatch any POM-V medicines</li>
                        <li>Please ensure your pet has regular check-ups with your vet</li>
                        <li>Keep your prescriptions up to date to avoid delays</li>
                        <li>Contact us if you need help with your prescription order</li>
                    </ul>
                </div>
            </div>

            <div class="contact-box">
                <h3>Need assistance with your prescription?</h3>
                <p>Our team is here to help. Contact us at:</p>
                <a href="tel:099110992" class="phone-link">099110992</a>
            </div>
        </div>
    </UserLayout>
</template>

<style scoped>
.prescription-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 2rem;
}

.header-section {
    text-align: center;
    margin-bottom: 3rem;
}

.header-section h1 {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 1rem;
}

.subtitle {
    font-size: 1.2rem;
    color: #666;
}

.content-section {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.info-block {
    background-color: #f8f9fa;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.info-block h2 {
    color: #4682b4;
    font-size: 1.4rem;
    margin-bottom: 1.5rem;
}

.info-block p {
    margin-bottom: 1rem;
    line-height: 1.6;
    color: #444;
}

.info-block ul {
    list-style-type: disc;
    padding-left: 1.5rem;
}

.info-block li {
    margin-bottom: 0.8rem;
    line-height: 1.6;
    color: #444;
}

.contact-box {
    margin-top: 3rem;
    text-align: center;
    background-color: #f0f8ff;
    padding: 2rem;
    border-radius: 8px;
}

.contact-box h3 {
    color: #333;
    margin-bottom: 1rem;
}

.phone-link {
    display: inline-block;
    color: #4682b4;
    font-size: 1.2rem;
    font-weight: 600;
    text-decoration: none;
    margin-top: 1rem;
}

.phone-link:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .header-section h1 {
        font-size: 2rem;
    }

    .info-block {
        padding: 1.5rem;
    }
}
</style>
