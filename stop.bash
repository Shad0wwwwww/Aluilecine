#!/bin/bash

# Colors and styles for the styled message
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No color

# Stop Docker Compose services
if docker-compose down -v; then
    echo -e "${GREEN}Docker Compose services stopped successfully. ${NC}"
else
    echo -e "${RED}Error stopping Docker Compose services. ${NC}"
    exit 1
fi

# Display a styled end message
echo -e "${YELLOW}-------------------------------------------------${NC}"
echo -e "${YELLOW} Closed ! ${NC}"
echo -e "${YELLOW}-------------------------------------------------${NC}"