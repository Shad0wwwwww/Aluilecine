#!/bin/bash

# Colors and styles for the styled message
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No color
IP=$(hostname -I | awk '{print $1}')

# Check if docker-compose is installed
if ! command -v docker-compose &> /dev/null; then
    echo -e "${RED}Docker Compose is not installed. Please install it first.${NC}"
    exit 1
fi

# Start Docker Compose
if docker-compose build; then
    echo -e "${GREEN}Docker Compose built successfully.${NC}"
    if docker-compose up -d; then
        echo -e "${GREEN}Docker Compose started successfully.${NC}"
    else
        echo -e "${RED}Error starting Docker Compose.${NC}"
        exit 1 # Stop script on error
    fi
else
    echo -e "${RED}Error building Docker Compose.${NC}"
    exit 1 # Stop script on error
fi

# Display a styled end message
echo -e "${YELLOW}-------------------------------------------------${NC}"
echo -e "${YELLOW} Your Docker services are now running! ${NC}"
echo -e "${GREEN} http://$IP/ ${NC}"
echo -e "${YELLOW}-------------------------------------------------${NC}"
