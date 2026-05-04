pipeline {
    agent none
    environment {
        AGENT_LABEL = ''
    }
    stages {
        stage("Set Agent Label") {
            steps {
                script {
                    if (env.BRANCH_NAME == 'main') {
                        currentBranch = 'production'
                    } else if (env.BRANCH_NAME == 'development') {
                        currentBranch = 'development'
                    } else {
                        currentBranch = 'development' // Change this to your default agent label if needed
                    }
                    script {
                        AGENT_LABEL = currentBranch
                    }
                }
            }
        }
        stage("Pull changes") {
            agent {
                label "${AGENT_LABEL}"
            }
            steps { 
                script { 
                    dir('scripts') {
                        sh 'sudo ./pull-remote-branch.sh'
                    }
                }
            }
        }
    }
}
