<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
defineOptions({
    layout: UserLayout,
});
</script>

<template>
    <div class="about-container">
        <div class="hero-section">
            <div class="content-wrapper">
                <h1 class="title">About Us</h1>
                <div class="hero-content">
                    <div class="image-container">
                        <img src="/images/about/hero-image.jpg" alt="Person with pet" class="hero-image" />
                        <!-- Removed circle-overlay div -->
                    </div>
                    <div class="text-content">
                        <p class="welcome-text">Welcome to PawPal</p>
                        <div class="description">
                            <p>Welcome to Peppa Pets PH, where your pet's comfort, health, and happiness come first.</p>

                            <p>
                                At Peppa Pets, we provide a complete experience tailored to your furry friend's needs. Whether it's a relaxing
                                grooming session, a cozy stay at our pet hotel, expert veterinary care, or quality pet supplies—everything we do is
                                rooted in love and care for animals.
                            </p>

                            <p>
                                We understand that pets are family, which is why we offer compassionate and personalized services. With our
                                experienced groomers, trusted vets, and caring staff, you can be confident your pets are in good hands. Open daily
                                from 9:00 AM to 8:00 PM, we make it easy for you to give your pet the care they deserve.
                            </p>

                            <p>
                                From stylish grooming to top-notch boarding and health care, Peppa Pets is your one-stop destination for everything
                                your beloved companion needs.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dedicated-section">
            <h2>Dedicated To You & Your Pet</h2>
            <div class="dedicated-content">
                Our friendly team is here to help you every step of the way. Whether you need advice on pet nutrition, help with choosing the right
                products, or support with your order, we're just a call or click away. We're passionate about pets and committed to providing you with
                the best possible service.
            </div>
        </div>
    </div>
</template>

<style scoped>
.about-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.hero-section {
    margin-bottom: 4rem;
}

.content-wrapper {
    position: relative;
}

.title {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 2rem;
}

.hero-content {
    display: flex;
    gap: 4rem;
    align-items: center;
}

.image-container {
    position: relative;
    flex: 0 0 45%;
}

.hero-image {
    width: 100%;
    height: auto;
    border-radius: 15px;
    position: relative;
    z-index: 2;
}

/* Remove these styles */
.circle-overlay {
    position: absolute;
    right: -20px;
    top: -20px;
    width: 200px;
    height: 200px;
    border: 30px solid #4682b4;
    border-radius: 50%;
    z-index: 1;
}

.text-content {
    flex: 1;
}

.welcome-text {
    font-size: 1.8rem;
    color: #4682b4;
    margin-bottom: 1.5rem;
    font-weight: 600;
}

.description {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #666;
}

.description p {
    margin-bottom: 1.5rem;
}

.description p:last-child {
    margin-bottom: 0;
}

.dedicated-section {
    padding: 4rem 0;
}

.dedicated-section h2 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 2rem;
}

@media (max-width: 768px) {
    .hero-content {
        flex-direction: column;
        gap: 2rem;
    }

    .image-container {
        flex: 0 0 100%;
    }

    .circle-overlay {
        width: 150px;
        height: 150px;
        border-width: 20px;
    }
}
</style>
