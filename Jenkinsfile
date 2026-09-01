pipeline {
    agent any
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        stage('Install Dependencies') {
            steps {
                sh 'composer install --optimize-autoloader'
            }
        }
        stage('Copy .env') {
            steps {
                sh 'cp .env.example .env'
                sh 'php artisan key:generate'
            }
        }
        stage('Run Tests') {
            steps {
                sh 'php artisan test'
            }
        }
        stage('Build Assets') {
            steps {
                sh 'npm install && npm run build'
            }
        }
        stage('Deploy') {
            environment {
                APP_ENV = 'production'   // taruh di sini saja, khusus stage deploy
            }
            when {
                branch 'main'
            }
            steps {
                sh '''
                    php artisan migrate --force
                    sudo systemctl restart digiflora
                '''
            }
        }
    }
}