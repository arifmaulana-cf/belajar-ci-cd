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

        stage('Build Assets') {
            steps {
                sh 'npm install && npm run build'
            }
        }

        stage('Run Tests') {
            steps {
                sh 'php artisan test'
            }
        }

        stage('Deploy') {
            environment {
                APP_ENV = 'production'
            }
            steps {
                sh '''
                    php artisan migrate --force
                    sudo systemctl restart digiflora
                '''
            }
        }
    }

    post {
        success {
            echo 'Build & deploy berhasil!'
        }
        failure {
            echo 'Build gagal, cek log di atas.'
        }
    }
}